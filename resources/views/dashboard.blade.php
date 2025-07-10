@extends('layouts.base')

@section('content')
    <h1>Bienvenue sur votre tableau de bord</h1>

    <p>Vous êtes connecté en tant que {{ auth()->user()->name ?? 'Lecteur' }}.</p>

    <ul>
        <li><a href="{{ route('livres.index') }}">Voir les livres</a></li>
        <li><a href="{{ route('lecteurs.index') }}">Voir les lecteurs</a></li>
        <li><a href="{{ route('users.index') }}">Voir la liste Utilisateurs</a></li>
        <li><a href="{{ route('emprunts.index') }}">Voir la liste des emprunts</a></li>
    </ul> 
@endsection
