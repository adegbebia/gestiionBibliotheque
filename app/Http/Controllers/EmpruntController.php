<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Lecteur;
use App\Models\Livre;
use Illuminate\Http\Request;
use App\Http\Requests\EmpruntRequest;
use Illuminate\Support\Facades\DB;

class EmpruntController extends Controller
{
    public function index(Request $request)
    {
        $query = Emprunt::with('lecteur.user');
        dd($query);
        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', $request->date_debut);
        }

        if ($request->filled('date_retour')) {
            $query->whereDate('date_retour', $request->date_retour);
        }

        $emprunts = $query->paginate(5)->appends($request->all());

        return view('emprunts.index', compact('emprunts'));
    }

    public function create()
    {
        $lecteurs = Lecteur::with('user')->get();
        $livres = Livre::where('quantite', '>', 0)->get(); // uniquement livres disponibles

        return view('emprunts.create', compact('lecteurs', 'livres'));
    }

   

    public function store(EmpruntRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();

            
            $emprunt = Emprunt::create([
                'date_debut'  => $data['date_debut'],
                'date_retour' => $data['date_retour'],
                'lecteur_id'  => $data['lecteur_id'],
            ]);

           
            foreach ($data['livres'] as $livre_id) {
                $livre = Livre::find($livre_id);

                if ($livre && $livre->quantite > 0) {
                    
                    DB::table('livre_emprunter')->insert([
                        'emprunt_id' => $emprunt->emprunt_id,
                        'livre_id'   => $livre_id,
                    ]);

                    
                    $livre->decrement('quantite');

                    
                    if ($livre->quantite == 0) {
                        $livre->delete();
                    }
                }
            }
        });

        return redirect()->route('emprunts.index')->with('success', 'Emprunt créé avec succès.');
    }


    public function show(Emprunt $emprunt)
    {
        $emprunt->load('lecteur.user', 'livres');
        return view('emprunts.show', compact('emprunt'));
    }

    public function edit(Emprunt $emprunt)
    {
        $emprunt->load('lecteur.user', 'livres');
        $lecteurs = Lecteur::with('user')->get();
        $livres = Livre::all(); 
        return view('emprunts.edit', compact('emprunt', 'lecteurs', 'livres'));
    }

    public function update(EmpruntRequest $request, Emprunt $emprunt)
    {
        DB::transaction(function () use ($request, $emprunt) {
            $data = $request->validated();

           
            foreach ($emprunt->livres as $livre) {
                $livre->increment('quantite');
            }

         
            DB::table('livre_emprunter')->where('emprunt_id', $emprunt->emprunt_id)->delete();

          
            $emprunt->update([
                'date_debut' => $data['date_debut'],
                'date_retour' => $data['date_retour'],
                'lecteur_id' => $data['lecteur_id'],
            ]);

      
            foreach ($data['livres'] as $livre_id) {
                DB::table('livre_emprunter')->insert([
                    'emprunt_id' => $emprunt->emprunt_id,
                    'livre_id' => $livre_id,
                ]);

                $livre = Livre::find($livre_id);
                if ($livre && $livre->quantite > 0) {
                    $livre->decrement('quantite');
                }
            }
        });

        return redirect()->route('emprunts.index')->with('success', 'Emprunt mis à jour avec succès.');
    }

    public function destroy(Emprunt $emprunt)
    {
        
        foreach ($emprunt->livres as $livre) {
            $livre->increment('quantite');
        }

        
        DB::table('livre_emprunter')->where('emprunt_id', $emprunt->emprunt_id)->delete();

        
        $emprunt->delete();

        return redirect()->route('emprunts.index')->with('success', 'Emprunt supprimé avec succès.');
    }
}
