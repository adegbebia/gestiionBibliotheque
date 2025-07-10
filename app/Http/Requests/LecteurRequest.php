<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Carbon\Carbon;


class LecteurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        
        $userId = $this->route('lecteur')?->user_id;

        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            /*'date_naissance' => ['required', 'date', function ($attribute, $value, $fail) {
            $age = Carbon::parse($value)->age;
            if ($age < 15) {
                $fail('Le lecteur doit avoir au moins 15 ans.');
            }
        }],*/
            'telephone' => 'required|string|max:20|unique:users,telephone' . ($userId ? ',' . $userId . ',user_id' : ''),
            'email' => 'required|email|unique:users,email' . ($userId ? ',' . $userId . ',user_id' : ''),
            'password' => $this->isMethod('post')
                ? 'required|string|min:6'
                : 'nullable|string|min:6',
            //'type' => 'required|in:eleve,enseignant,personnel',
            'est_abonne' => 'nullable|boolean',
        ];
    }
}
