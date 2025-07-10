<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Lecteur;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative de connexion avec un compte User
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // Tentative de connexion comme Lecteur
        $lecteur = Lecteur::whereHas('user', function ($query) use ($credentials) {
            $query->where('email', $credentials['email']);
        })->with('user')->first();

        if ($lecteur && Hash::check($credentials['password'], $lecteur->user->password)) {
            session(['lecteur_id' => $lecteur->lecteur_id]);
            $request->session()->regenerate();

            return redirect()->route('dashboard'); 
        }

        return back()->withErrors([
            'email' => 'Adresse email ou mot de passe invalide.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->forget('lecteur_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }
}
