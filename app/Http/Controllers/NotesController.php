<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notes;
use App\Models\Subjects;
use App\Models\User;
use App\Notifications\NewMarkNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use Carbon\Carbon;

class NotesController extends Controller
{
    public function show(){
        $user = Auth::user();

        if ($user->userType === 2){
            $students = User::where('userType', 1)->orderBY('name', 'asc')->get();
            $evaluations = Evaluation::where('user_id', $user->id)->with(['notes' => function ($query) {$query->orderBy('mark', 'desc');}])->orderBY('created_at', 'desc')->get();
            return view('note', ['students' => $students, 'evaluations' => $evaluations]);
        }
        elseif ($user->userType === 1){
            $subjects = Subjects::all();
            $notes = Notes::where('user_id', $user->id)->with('evaluations.subjectModel')->orderBY('created_at', 'desc')->get();
            return view('note', ['notes' => $notes, 'subjects' => $subjects]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'coefficient' => ['required', 'numeric', 'min:0'],
        ]);
    
        $user = Auth::user();
        $evaluationId = $request->get('evaluationSelect');

        if ($evaluationId) {
            // Mise à jour de l'évaluation
            $evaluation = Evaluation::findOrFail($evaluationId);
            $evaluation->update([
                'title' => $request->input('title'),
                'coefficient' => $request->input('coefficient'),
            ]);
    
            // Mise à jour des notes
            $students = User::where('userType', 1)->get();
            foreach ($students as $student) {
                $note = Notes::where('user_id', $student->id)
                             ->where('evaluations_id', $evaluationId)
                             ->first();
                if ($note) {
                    $note->update([
                        'mark' => $request->input("notes.{$student->id}.note"),
                        'description' => $request->input("notes.{$student->id}.description"),
                    ]);
                }
            }
            return redirect()->route('notes')->with('success', 'Évaluation et notes mises à jour avec succès.');
        } else {
        // Enregistrement de l'évaluation
        $evaluation = new Evaluation();
        $evaluation->user_id = $user->id;
        $evaluation->subject_id = $user->subject_id;
        $evaluation->title = $request->input('title');
        $evaluation->coeff = $request->input('coefficient');

        $evaluation->load('subjectModel');

        $evaluation->save();
    
        // Enregistrement des notes
        $students = User::where('userType', 1)->get();
        foreach ($students as $student) {
            $note = new Notes();
            $note->user_id = $student->id;
            $note->evaluations_id = $evaluation->id;
            $note->evaluations_subject_id = $evaluation->subject_id;
            $note->evaluations_user_id = $evaluation->user_id;
            $note->mark = $request->input("notes.{$student->id}.note");
            $note->description = $request->input("notes.{$student->id}.description");
            $note->save();

            // Enregistrement de notification
            $notification = new Notifications();
            $notification->user_id = $student->id;
            $notification->subject_id = $evaluation->subject_id;
            $notification->type = 1; // 1 pour notification de note
            $notification->content = "Nouveau : note en {$evaluation->subjectModel->subjectName} du " . Carbon::parse($note->created_at)->locale('fr')->isoFormat('D MMMM YYYY') . ", {$note->mark}/20.";
            $notification->save();

            $student->notify(new NewMarkNotification($note));

        }
    
        return redirect()->route('notes')->with('success', 'Évaluation et notes enregistrées avec succès.');
    }
}
}
