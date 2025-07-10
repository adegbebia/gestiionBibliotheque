<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $livreId = optional($this->route('livre'))->livre_id;

        return [
            'titre'      => 'required|string|max:255',
            'auteur'     => 'required|string|max:255',
            'resume'     => 'nullable|string',
            'isbn'       => $livreId
                ? 'nullable|string|max:255|unique:livres,isbn,' . $livreId . ',livre_id'
                : 'nullable|string|max:255|unique:livres,isbn',
            'quantite'   => 'required|integer|min:1',
            'pdf_url'    => 'nullable|file|mimes:pdf',
            
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required'        => 'Le titre est obligatoire.',
            'auteur.required'       => 'L’auteur est obligatoire.',
            'isbn.unique'           => 'Cet ISBN est déjà utilisé.',
            'disponible.required'   => 'Le champ disponibilité est obligatoire.',
            'pdf_url.file'          => 'Le fichier doit être un fichier valide.',
            'pdf_url.mimes'         => 'Le fichier doit être un PDF.',
            //'pdf_url.max'           => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}