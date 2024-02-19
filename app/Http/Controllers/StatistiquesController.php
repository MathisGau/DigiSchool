<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notes;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistiquesController extends Controller
{
    public function show()
{
    $user = Auth::user();

    if ($user->userType === 2) {
        $evaluations = Evaluation::where('user_id', $user->id)
            ->with(['notes' => function ($query) {
                $query->orderBy('mark', 'desc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [];

        foreach ($evaluations as $evaluation) {
            $stats[$evaluation->id] = [
                'min' => $evaluation->notes->min('mark'),
                'max' => $evaluation->notes->max('mark'),
                'avg' => $evaluation->notes->avg('mark'),
            ];
        }

        return view('statistiques', [
            'evaluations' => $evaluations,
            'stats' => $stats,
        ]);
    } elseif ($user->userType === 1) {
        $subjects = Subjects::with(['notes' => function ($query) use ($user) {
            $query->where('user_id', $user->id)->with('evaluations');
        }])->get();
    
        $bulletin = [];
    
        foreach ($subjects as $subject) {
            $totalMark = 0;
            $totalCoefficient = 0;
    
            foreach ($subject->notes as $note) {
                $totalMark += $note->mark * $note->evaluations->coeff;
                $totalCoefficient += $note->evaluations->coeff;
            }
    
            if ($totalCoefficient > 0) {
                $average = $totalMark / $totalCoefficient;
                $bulletin[$subject->subjectName] = number_format($average, 2);
            } else {
                $bulletin[$subject->subjectName] = 'N/A';
            }
        }
    
        return view('statistiques', compact('bulletin'));
    }  
}
}
