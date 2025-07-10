<div class="navbar bg-base-100 shadow-sm px-4">
    <!-- Gauche : Logo -->
    {{-- <div class="flex-1">
        <a href="/">Bibliothèque</a>
    </div> --}}

    <!-- Droite : avatar utilisateur ou bouton Connexion -->
    <div class="flex-none ml-auto">
        @auth
            <!-- Dropdown avatar -->
            <div >
                <div tabindex="0" role="button" ">
                    <div ">
                    </div>
                </div>
                <ul tabindex="0"
                   >
                    {{-- <li><a href="#">Profil</a></li> --}}
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Se déconnecter</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
        @endauth
    </div>
</div>
