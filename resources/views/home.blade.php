@extends('layouts.base')

@section('content')
    <div>
        <h2>Bienvenue à la bibliothèque</h2>

        <p>
            <a href="{{ route('lecteurs.register') }}">S'inscrire</a> |
            <a href="{{ route('login') }}">Se connecter</a>
        </p>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </div>
@endsection
