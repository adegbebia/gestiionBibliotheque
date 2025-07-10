@extends('layouts.base')

@section('title', 'Détails du Livre')

@section('content')
    <div>
        <h2>Détails du Livre</h2>

        <div>
            <strong>Titre :</strong> {{ $livre->titre }}
        </div>

        <div>
            <strong>Auteur :</strong> {{ $livre->auteur }}
        </div>

        <div>
            <strong>Résumé :</strong>
            <p>
                {{ $livre->resume ?? 'Aucun résumé disponible.' }}
            </p>
        </div>

        <div>
            <strong>ISBN :</strong> {{ $livre->isbn ?? 'Non fourni' }}
        </div>

        <div>
            <strong>Quantité disponible :</strong> 
            {{ $livre->quantite > 0 ? $livre->quantite : 'Indisponible pour le moment' }}
        </div>

        @if ($livre->pdf_url)
            <div>
                <a href="{{ asset('storage/' . $livre->pdf_url) }}" target="_blank">
                    📄 Voir le PDF
                </a>
            </div>
        @endif

        <div style="margin-top: 10px;">
            <a href="{{ route('livres.index') }}">← Retour à la liste</a>
        </div>
    </div>
@endsection
