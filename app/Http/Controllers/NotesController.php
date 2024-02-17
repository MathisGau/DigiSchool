<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function show(){
        $user = Auth::user();

        if ($user->userType === 2){
            $students = User::where('userType', 1)->get();
            $evaluations = Evaluation::all();
            return view('note', ['students' => $students, 'evaluations' => $evaluations]);
        }
        elseif ($user->userType === 1){
            $notes = Notes::where('user_id', $user->id)->with('evaluation')->get();
            return view('note', ['notes' => $notes]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'coefficient' => ['required', 'numeric', 'min:0'],
        ]);
    
        $user = Auth::user();
    
        // Enregistrement de l'évaluation
        $evaluation = new Evaluation();
        $evaluation->user_id = $user->id;
        $evaluation->subject = $user->subject;
        $evaluation->title = $request->input('title');
        $evaluation->coeff = $request->input('coefficient');
        $evaluation->save();
    
        // Enregistrement des notes
        $students = User::where('userType', 1)->get();
        foreach ($students as $student) {
            $note = new Notes();
            $note->user_id = $student->id;
            $note->evaluations_id = $evaluation->id;
            $note->evaluations_subject = $evaluation->subject;
            $note->evaluations_user_id = $evaluation->user_id;
            $note->mark = $request->input("notes.{$student->id}.note");
            $note->description = $request->input("notes.{$student->id}.description");
            $note->save();
        }
    
        return redirect()->route('notes')->with('success', 'Évaluation et notes enregistrées avec succès.');
    }
    
}
