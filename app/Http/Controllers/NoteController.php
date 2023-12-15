<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $userNotes = auth()->user()->notes;
        return view('notes')->with('userNotes', $userNotes);
    }
    public function notes()
    {
        $allNotes = Note::all();

        return view('notes')->with('allNotes', $allNotes);
    }
}
