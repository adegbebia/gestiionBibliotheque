<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lecteur;
use Illuminate\Support\Facades\Hash;

class LecteurAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('lecteurs.register');
    }

    public function register(Request $request)
    {
     
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'type' => 'required|in:eleve,enseignant,personnel',
        ]);

        $user = User::create([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'fonction' => 'lecteur',
        ]);

       
        Lecteur::create([
            'user_id' => $user->id,
            'date_naissance' => $validated['date_naissance'] ?? null,
            'telephone' => $validated['telephone'],
            'type' => $validated['type'],
            'est_abonne' => true,
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie ! Vous pouvez vous connecter.');
    }
}
