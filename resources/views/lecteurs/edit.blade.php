@extends('layouts.base')

@section('title', 'Modifier un lecteur')

@section('content')
<div>
    <h1>Modifier un lecteur</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lecteurs.update', $lecteur) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $nom ?? '') }}" required>
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $prenom ?? '') }}" required>
        </div>

        <div>
            <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance"
                   value="{{ old('date_naissance', $lecteur->user->date_naissance ? $lecteur->user->date_naissance->format('Y-m-d') : '') }}">
        </div>

        <div>
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone"
                   value="{{ old('telephone', $lecteur->user->telephone) }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $lecteur->user->email) }}" required>
        </div>

        <div>
            <label for="password">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" id="password">
        </div>

        {{-- <div>
            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="" disabled {{ old('type', $lecteur->type) ? '' : 'selected' }}>-- Choisir un type --</option>
                <option value="eleve" {{ old('type', $lecteur->type) === 'eleve' ? 'selected' : '' }}>Élève</option>
                <option value="enseignant" {{ old('type', $lecteur->type) === 'enseignant' ? 'selected' : '' }}>Enseignant</option>
                <option value="personnel" {{ old('type', $lecteur->type) === 'personnel' ? 'selected' : '' }}>Personnel</option>
            </select>
        </div> --}}

        <div>
            <input type="checkbox" name="est_abonne" id="est_abonne" value="1" {{ old('est_abonne', $lecteur->est_abonne) ? 'checked' : '' }}>
            <label for="est_abonne">Est abonné ?</label>
        </div>

        <div>
            <button type="submit">Mettre à jour</button>
            <a href="{{ route('lecteurs.index') }}">Annuler</a>
        </div>
    </form>
</div>
@endsection
