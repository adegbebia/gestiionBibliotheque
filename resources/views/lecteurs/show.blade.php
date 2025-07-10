@extends('layouts.base')

@section('title', 'Détails du lecteur')

@section('content')
<div>
    <h1>Détails du lecteur</h1>

    <p><strong>Nom :</strong> {{ $lecteur->user->name ?? '—' }}</p>
    <p><strong>Email :</strong> {{ $lecteur->user->email ?? '—' }}</p>
    <p><strong>Téléphone :</strong> {{ $lecteur->user->telephone ?? '—' }}</p>
    <p><strong>Date de naissance :</strong> 
        {{ $lecteur->user->date_naissance ? $lecteur->user->date_naissance->format('d/m/Y') : '—' }}
    </p>
    <p><strong>Type :</strong> {{ ucfirst($lecteur->type) }}</p>
    <p><strong>Abonné :</strong> {{ $lecteur->est_abonne ? 'Oui' : 'Non' }}</p>

    <div>
        <a href="{{ route('lecteurs.edit', $lecteur) }}">Modifier</a>
        <a href="{{ route('lecteurs.index') }}">Retour à la liste</a>
    </div>
</div>
@endsection
