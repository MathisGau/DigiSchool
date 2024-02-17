<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistiquesController extends Controller
{
    public function show(){
        $user = Auth::user();

        $notes = Notes::where('user_id', $user->id)->with('evaluation')->get();

        return view('statistiques', ['notes' => $notes]);
    }
}
