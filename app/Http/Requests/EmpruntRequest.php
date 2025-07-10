<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpruntRequest extends FormRequest
{
    public function authorize()
    {
     
        return true;
    }

    public function rules()
    {
        return [
            'date_debut' => ['required', 'date'],
            'date_retour' => ['required', 'date', 'after_or_equal:date_debut'],
            'lecteur_id' => ['required', 'exists:lecteurs,lecteur_id'],

          
            'livres' => ['required', 'array', 'min:1'],
            'livres.*' => ['exists:livres,livre_id'],
        ];
    }

    public function messages()
    {
        return [
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',

            'date_retour.required' => 'La date de retour est obligatoire.',
            'date_retour.date' => 'La date de retour doit être une date valide.',
            'date_retour.after_or_equal' => 'La date de retour doit être postérieure ou égale à la date de début.',

            'lecteur_id.required' => 'Le lecteur est obligatoire.',
            'lecteur_id.exists' => 'Le lecteur sélectionné est invalide.',

            'livres.required' => 'Vous devez sélectionner au moins un livre à emprunter.',
            'livres.array' => 'Les livres doivent être transmis sous forme de liste.',
            'livres.min' => 'Vous devez sélectionner au moins un livre à emprunter.',
            'livres.*.exists' => 'Un ou plusieurs livres sélectionnés sont invalides.',
        ];
    }
}
