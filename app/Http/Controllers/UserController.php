<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use \App\Models\Lecteur;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index(Request $request)

    {
        $query = User::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%");
    }

    $users = $query->paginate(5)->appends($request->only('search'));
    
    return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche un utilisateur spécifique.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour les données d'un utilisateur.
     */
    public function update(UserRequest $request, User $user)
{
    $validated = $request->validated();

    
    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

    
    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}


  

    public function destroy(User $user)
{
    // Récupérer le lecteur lié au user
    $lecteur = Lecteur::where('user_id', $user->user_id)->first();

    if ($lecteur) {
        // 🟡 On compte explicitement les emprunts
        $nbEmprunts = $lecteur->emprunts()->count();

        if ($nbEmprunts > 0) {
            return back()->with('error', 'Ce lecteur a encore ' . $nbEmprunts . ' emprunt(s) actif(s). Suppression impossible.');
        }

        // ✅ Supprimer le lecteur s’il n’a aucun emprunt
        $lecteur->delete();
    }

    // ✅ Supprimer l’utilisateur
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
}
    }
