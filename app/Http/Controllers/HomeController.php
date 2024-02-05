<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function compte()
    {
        return view('compte');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function notes()
    {
        return view('notes');
    }
}
