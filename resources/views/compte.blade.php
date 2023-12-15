@extends('Layouts.app')

@section('content')
    <h1>Mon Compte</h1>
    <p>Nom d'utilisateur : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Compte : {{ $user->userType }}</p>
@endsection
