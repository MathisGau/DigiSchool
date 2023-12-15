@extends('Layouts.app')

@section('menu')
    <nav>
        <ul>
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('notes') }}">Notes</a></li>
            <li><a href="{{ route('compte') }}">Compte</a></li>
        </ul>
    </nav>
@endsection
