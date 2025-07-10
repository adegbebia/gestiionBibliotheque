<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Http\Requests\LivreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
   public function index(Request $request)
{
    $query = Livre::query();

    
    if ($request->has('search') && $request->filled('search')) {
        $search = $request->input('search');
        $query->where('auteur', 'like', "%{$search}%");
    }

    $query->where('quantite', '>', 0);

    $livres = $query->paginate(5)->appends($request->only('search'));

    return view('livres.index', compact('livres'));
}




    public function create()
    {
        return view('livres.create');
    }

    public function store(LivreRequest $request): RedirectResponse
    {
        $data = $request->validated();

       
        if ($request->hasFile('pdf_url') && $request->file('pdf_url')->isValid()) {
            $data['pdf_url'] = $request->file('pdf_url')->store('pdfs', 'public');
        }

        
        Livre::create($data);

        return redirect()->route('livres.index')
            ->with('success', 'Livre ajouté avec succès !');
    }

    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    public function update(LivreRequest $request, Livre $livre): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('pdf_url') && $request->file('pdf_url')->isValid()) {
            
            if ($livre->pdf_url && Storage::disk('public')->exists($livre->pdf_url)) {
                Storage::disk('public')->delete($livre->pdf_url);
            }

            $data['pdf_url'] = $request->file('pdf_url')->store('pdfs', 'public');
        }

        $livre->update($data);

        return redirect()->route('livres.index')
            ->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(Livre $livre): RedirectResponse
    {
        if ($livre->pdf_url && Storage::disk('public')->exists($livre->pdf_url)) {
            Storage::disk('public')->delete($livre->pdf_url);
        }

        $livre->delete();

        return redirect()->route('livres.index')
            ->with('success', 'Livre supprimé avec succès.');
    }
}