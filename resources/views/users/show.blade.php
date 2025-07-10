@extends('layouts.base')

@section('content')
    <h2>Détails de l'utilisateur</h2>

    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Date de naissance :</strong> {{ $user->date_naissance ?? '-' }}</p>
    <p><strong>Téléphone :</strong> {{ $user->telephone ?? '-' }}</p>
    <p><strong>Fonction :</strong> {{ $user->fonction ?? '-' }}</p>

    <p>
        <a href="{{ route('users.edit', $user->user_id) }}">Modifier</a> |
        <a href="{{ route('users.index') }}">Retour à la liste</a>
    </p>
@endsection
