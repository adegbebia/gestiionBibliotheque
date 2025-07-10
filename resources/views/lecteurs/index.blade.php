@extends('layouts.base')

@section('title', 'Liste des Lecteurs')

@section('content')
    <div>
        <div>
            <h1>Liste des Lecteurs</h1>
            <div style="text-align: right; margin-bottom: 15px;">
                <a href="{{ route('lecteurs.create') }}">
                    <button>Ajouter un lecteur</button>
                </a>

            </div>

            <div style="text-align: right; margin-bottom: 15px;">
                <a href="{{ route('dashboard') }}">
                    <button style="  padding: 8px 16px; border: none; border-radius: 4px;">
                        Retour au Dashboard
                    </button>
                </a>
            </div>
        </div>

        <div>
            <form method="GET" action="{{ route('lecteurs.index') }}">
                <input type="text" name="search" placeholder="Rechercher par nom ou email..."
                    value="{{ request('search') }}">
                <button type="submit">Rechercher</button>
            </form>

        </div>

        <div>
            <table style="border-collapse: collapse; width: 100%;" border="1">
                <thead>
                    <tr>
                        <th style="border: 1px solid black;">#</th>
                        <th style="border: 1px solid black;">Nom complet</th>
                        <th style="border: 1px solid black;">Email</th>
                        <th style="border: 1px solid black;">Téléphone</th>
                        <th style="border: 1px solid black;">Date de naissance</th>
                        <th style="border: 1px solid black;">Abonné</th>
                        <th style="border: 1px solid black;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lecteurs as $lecteur)
                        <tr>
                            <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid black;">{{ $lecteur->user->name }}</td>
                            <td style="border: 1px solid black;">{{ $lecteur->user->email }}</td>
                            <td style="border: 1px solid black;">{{ $lecteur->user->telephone ?? '—' }}</td>
                            <td style="border: 1px solid black;">
                                {{ $lecteur->user->date_naissance ? $lecteur->user->date_naissance->format('d/m/Y') : '—' }}
                            </td>
                            <td style="border: 1px solid black;">{{ $lecteur->est_abonne ? 'Oui' : 'Non' }}</td>
                            <td style="border: 1px solid black;">
                                <a href="{{ route('lecteurs.show', $lecteur) }}">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                    </button>

                                </a>
                                <a href="{{ route('lecteurs.edit', $lecteur) }}">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                </a>
                                <form action="{{ route('lecteurs.destroy', $lecteur) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; border: 1px solid black;">Aucun lecteur trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


            <div>
                {{ $lecteurs->links() }}
            </div>
        </div>
    </div>
@endsection
