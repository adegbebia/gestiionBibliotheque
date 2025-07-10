<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lecteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }

  
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        
        $nomComplet = $request->prenom . ' ' . $request->nom;

        // Création de l'utilisateur
        $user = new User();
        $user->name = $nomComplet;
        $user->date_naissance = $request->date_naissance;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->fonction = 'lecteur';
        $user->save();

        // Création du lecteur lié à l'utilisateur
        Lecteur::create([
            'user_id' => $user->user_id, 
            'est_abonne' => true,
        ]);

        // Redirection vers login avec message de succès
        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
        //return redirect()->route('home')->with('success', 'Inscription réussie. Connectez-vous maintenant.');

    }
}
