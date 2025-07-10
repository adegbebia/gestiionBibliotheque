@extends('layouts.base')

@section('content')
<div>
    <h2>Modifier un livre</h2>

    {{-- Affiche les erreurs de validation --}}
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('livres.update', $livre->livre_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $livre->titre) }}" required>
            @error('titre')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Auteur</label>
            <input type="text" name="auteur" value="{{ old('auteur', $livre->auteur) }}" required>
            @error('auteur')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Résumé</label>
            <textarea name="resume" rows="4">{{ old('resume', $livre->resume) }}</textarea>
            @error('resume')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>PDF (fichier)</label>
            <input type="file" name="pdf_url" accept="application/pdf">
            @error('pdf_url')
                <div style="color:red">{{ $message }}</div>
            @enderror

            @if ($livre->pdf_url)
                <p>
                    📥 <a href="{{ asset('storage/' . $livre->pdf_url) }}" target="_blank" download>
                        Télécharger le PDF existant
                    </a>
                </p>
            @endif
        </div>

        <div>
            <label>ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn', $livre->isbn) }}">
            @error('isbn')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Quantité</label>
            <input type="number" name="quantite" min="1" value="{{ old('quantite', $livre->quantite) }}" required>
            @error('quantite')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 1rem;">
            <a href="{{ route('livres.index') }}">Annuler</a>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
