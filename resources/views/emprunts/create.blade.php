@extends('layouts.base')

@section('title', 'Nouvel emprunt')

@section('content')
<h1>Nouvel emprunt</h1>

<form action="{{ route('emprunts.store') }}" method="POST">
    @csrf

    <label for="date_debut">Date début :</label>
    <input type="date" name="date_debut" required><br>

    <label for="date_retour">Date retour :</label>
    <input type="date" name="date_retour" required><br>

    <label for="lecteur_id">Lecteur :</label>
    <select name="lecteur_id" required>
        <option value="">-- Choisir un lecteur --</option>
        @foreach($lecteurs as $lecteur)
            <option value="{{ $lecteur->lecteur_id }}">
                {{ $lecteur->user->name }}
            </option>
        @endforeach
    </select><br>

    <label for="livres">Livres à emprunter :</label>
    <select name="livres[]" multiple required size="5" style="width: 300px;">
        @foreach($livres as $livre)
            <option value="{{ $livre->livre_id }}">
                {{ $livre->titre }} ({{ $livre->quantite }} disponibles)
            </option>
        @endforeach
    </select>
    <p><small>Maintenez la touche Ctrl pour sélectionner plusieurs livres.</small></p><br>

    <button type="submit">Enregistrer</button>
</form>
@endsection
