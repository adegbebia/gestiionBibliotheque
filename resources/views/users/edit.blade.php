@extends('layouts.base')

@section('content')
<h2>Modifier un utilisateur</h2>

<form action="{{ route('users.update', $user->user_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Nom complet</label><br>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="date_naissance">Date de naissance</label><br>
        <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}">
        @error('date_naissance')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="telephone">Téléphone</label><br>
        <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}">
        @error('telephone')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="fonction">Fonction</label><br>
        <select name="fonction" id="fonction">
            <option value="">-- Sélectionner --</option>
            <option value="bibliothecaire" {{ old('fonction', $user->fonction) == 'bibliothecaire' ? 'selected' : '' }}>Bibliothécaire</option>
            <option value="administrateur" {{ old('fonction', $user->fonction) == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
            <option value="lecteur" {{ old('fonction', $user->fonction) == 'lecteur' ? 'selected' : '' }}>Lecteur</option>
        </select>
        @error('fonction')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <a href="{{ route('users.index') }}">Annuler</a>
        <button type="submit">Mettre à jour</button>
    </div>
</form>
@endsection
