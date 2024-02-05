<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function index()
    {
        return view('compte');
    }
    public function compte()
    {
        $user = auth()->user();
        return view('compte')->with('user', $user);
    }

}