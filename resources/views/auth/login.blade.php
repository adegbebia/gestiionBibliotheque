@extends('layouts.base')

@section('title', 'Connexion')

@section('content')
    <div>
        <div>
            <h2>Connexion</h2>

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Erreur de session --}}
            @if(session('error'))
                <div>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                           placeholder="exemple@gmail.com"
                           value="{{ old('email') }}" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password"
                           placeholder="Mot de passe" required>
                </div>

                <!-- Submit -->
                <button type="submit">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
@endsection
