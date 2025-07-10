@extends('layouts.base')

@section('title', 'Inscription Lecteur')

@section('content')
    <h1>Inscription d’un lecteur</h1>

 
    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('lecteurs.register') }}" id="lecteur-form">
        @csrf

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <label for="password_confirmation">Confirmer le mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

        <button type="submit">S’inscrire</button>
    </form>
@endsection

{{-- @section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("lecteur-form");
        const dateInput = document.getElementById("date_naissance");

        form.addEventListener("submit", function (event) {
            const value = dateInput.value;
            if (!value) return;

            const today = new Date();
            const birthDate = new Date(value);
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (age <= 15) {
        e.preventDefault();
        alert("L'âge doit être strictement supérieur à 15 ans pour s'inscrire.");
        }
        });
    });
</script>
@endsection --}}
