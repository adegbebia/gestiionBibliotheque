@extends('layouts.base')

@section('title', 'Ajouter un nouveau livre')

@section('content')
    <h1>Ajouter un nouveau livre</h1>

    <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Titre :</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="{{ $errors->has('titre') ? 'error' : '' }}">
            @error('titre')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <label>Auteur :</label>
            <input type="text" name="auteur" value="{{ old('auteur') }}" class="{{ $errors->has('auteur') ? 'error' : '' }}">
            @error('auteur')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <label>Résumé :</label>
            <textarea name="resume" class="{{ $errors->has('resume') ? 'error' : '' }}">{{ old('resume') }}</textarea>
            @error('resume')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <label>PDF (fichier) :</label>
            <input type="file" name="pdf_url" accept="application/pdf">
            @error('pdf_url')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <label>ISBN :</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}" class="{{ $errors->has('isbn') ? 'error' : '' }}">
            @error('isbn')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <label>Quantité :</label>
            <input type="number" name="quantite" min="1" value="{{ old('quantite', 1) }}" class="{{ $errors->has('quantite') ? 'error' : '' }}">
            @error('quantite')
                <div><span class="error-msg">{{ $message }}</span></div>
            @enderror
        </div>

        <div>
            <button type="submit">Enregistrer</button>
        </div>
    </form>
@endsection
