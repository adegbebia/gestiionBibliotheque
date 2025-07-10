<?php

namespace App\Http\Controllers;

use App\Models\Lecteur;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LecteurRequest;
use Illuminate\Http\Request;


class LecteurController extends Controller
{
    public function index(Request $request)
    {
        $query = Lecteur::with('user');

        if ($request->has('search')) {
            $search = $request->input('search');
      
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $lecteurs = $query->paginate(5)->appends($request->only('search'));

        return view('lecteurs.index', compact('lecteurs'));
    }

    public function create()
    {
        return view('lecteurs.create');
    }

    public function store(LecteurRequest $request)
    {
        $validated = $request->validated();

        $nomComplet = $validated['prenom'] . ' ' . $validated['nom'];

        $user = User::create([
            'name' => $nomComplet,
            'date_naissance' => $validated['date_naissance'] ?? null,
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'fonction' => 'lecteur',
        ]);

        Lecteur::create([
            'user_id' => $user->user_id,
            //'type' => $validated['type'],
            'est_abonne' => $request->has('est_abonne'),
        ]);

        return redirect()->route('lecteurs.index')->with('success', 'Lecteur ajouté avec succès.');
    }

    public function show(Lecteur $lecteur)
    {   //dd($lecteur, $lecteur->user);
        $lecteur->load('user');
        
        return view('lecteurs.show', compact('lecteur'));
    }

    public function edit(Lecteur $lecteur)
{
    $lecteur->load('user');

    
    $parts = explode(' ', $lecteur->user->name, 2);
    $prenom = $parts[0] ?? '';
    $nom = $parts[1] ?? '';

    return view('lecteurs.edit', compact('lecteur', 'prenom', 'nom'));
}


    public function update(LecteurRequest $request, Lecteur $lecteur)
    {
        $validated = $request->validated();
        $user = $lecteur->user;

        $user->name = $validated['prenom'] . ' ' . $validated['nom'];
        $user->date_naissance = $validated['date_naissance'] ?? null;
        $user->telephone = $validated['telephone'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        //$lecteur->type = $validated['type'];
        $lecteur->est_abonne = $request->has('est_abonne');
        $lecteur->save();

        return redirect()->route('lecteurs.index')->with('success', 'Lecteur mis à jour avec succès.');
    }

    public function destroy(Lecteur $lecteur)
    {   
        // // Vérifie si le lecteur a des emprunts liés
        // if ($lecteur->emprunts()->exists()) {
        // return back()->with('error', 'Ce lecteur a des emprunts enregistrés et ne peut pas être supprimé.');
        // }
        
        $lecteur->emprunts()->delete();
        $lecteur->delete();
        $lecteur->user()->delete();

        return redirect()->route('lecteurs.index')->with('success', 'Lecteur supprimé avec succès.');
    }
}
