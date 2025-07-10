@extends('layouts.base')

@section('title', 'Modifier un emprunt')

@section('content')
    <h1>Modifier un emprunt</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('emprunts.update', $emprunt) }}">
        @csrf
        @method('PUT')

        <label>Date de début:</label>
        <input type="date" name="date_debut" value="{{ old('date_debut', $emprunt->date_debut) }}" required><br>

        <label>Date de retour:</label>
        <input type="date" name="date_retour" value="{{ old('date_retour', $emprunt->date_retour) }}" required><br>

        <label>Lecteur:</label>
        <select name="lecteur_id" required>
            @foreach($lecteurs as $lecteur)
                <option value="{{ $lecteur->lecteur_id }}" {{ $lecteur->lecteur_id == old('lecteur_id', $emprunt->lecteur_id) ? 'selected' : '' }}>
                    {{ $lecteur->user->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Livres empruntés :</label>
        <select name="livres[]" multiple size="5" style="width: 300px;" required>
            @foreach($livres as $livre)
                <option value="{{ $livre->livre_id }}"
                    {{ in_array($livre->livre_id, old('livres', $emprunt->livres->pluck('livre_id')->toArray())) ? 'selected' : '' }}>
                    {{ $livre->titre }} ({{ $livre->quantite }} disponibles)
                </option>
            @endforeach
        </select>
        <p><small>Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs livres.</small></p><br>

        <button type="submit">Mettre à jour</button>
        <a href="{{ route('emprunts.index') }}">Annuler</a>
    </form>
@endsection
