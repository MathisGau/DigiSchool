@extends('Layouts.app')

@section('menu')
    <nav>
        <ul>
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('notes.index') }}">Notes</a></li>
            <li><a href="{{ route('compte.index') }}">Compte</a></li>
        </ul>
    </nav>
@endsection
