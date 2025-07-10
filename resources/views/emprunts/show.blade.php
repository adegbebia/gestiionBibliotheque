@extends('layouts.base')

@section('title', 'Détails de l’emprunt')

@section('content')
    <h1>Détails de l’emprunt</h1>

    <p><strong>Date de début :</strong> {{ $emprunt->date_debut }}</p>
    <p><strong>Date de retour :</strong> {{ $emprunt->date_retour }}</p>
    <p><strong>Lecteur :</strong> {{ optional($emprunt->lecteur?->user)->name ?? '-' }}</p>

    <p><strong>Livres empruntés :</strong></p>
    @if($emprunt->livres && $emprunt->livres->count())
        <ul>
            @foreach($emprunt->livres as $livre)
                <li>{{ $livre->titre }}</li>
            @endforeach
        </ul>
    @else
        <p>Aucun livre emprunté.</p>
    @endif

    <a href="{{ route('emprunts.edit', $emprunt) }}">✏️ Modifier</a> |
    <a href="{{ route('emprunts.index') }}">↩️ Retour à la liste</a>
@endsection
