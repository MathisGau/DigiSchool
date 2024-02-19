<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notes;
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
        return view('statistiques');
    }
}
}
