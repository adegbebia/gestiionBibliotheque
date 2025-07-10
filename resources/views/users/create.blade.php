@extends('layouts.base')

@section('content')
<h2>Créer un nouvel utilisateur</h2>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <!-- Nom -->
    <div>
        <label for="name">Nom complet</label><br>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Date de naissance -->
    <div>
        <label for="date_naissance">Date de naissance</label><br>
        <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}">
        @error('date_naissance')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Téléphone -->
    <div>
        <label for="telephone">Téléphone</label><br>
        <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}">
        @error('telephone')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Fonction -->
    <div>
        <label for="fonction">Fonction</label><br>
        <select name="fonction" id="fonction">
            <option value="">-- Sélectionner --</option>
            <option value="bibliothecaire" {{ old('fonction') == 'bibliothecaire' ? 'selected' : '' }}>Bibliothécaire</option>
            <option value="administrateur" {{ old('fonction') == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
            <option value="lecteur" {{ old('fonction') == 'lecteur' ? 'selected' : '' }}>Lecteur</option>
        </select>
        @error('fonction')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Mot de passe -->
    <div>
        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password" required>
        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirmation mot de passe -->
    <div>
        <label for="password_confirmation">Confirmer le mot de passe</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <!-- Boutons -->
    <div>
        <a href="{{ route('users.index') }}">Annuler</a>
        <button type="submit">Enregistrer</button>
    </div>
</form>
@endsection
