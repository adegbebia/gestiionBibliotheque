<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Autorise la requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     */
    public function rules(): array
    {
      
        $user = $this->route('user');
        $userId = $user ? $user->user_id : null;


        return [
            'name' => 'required|string|max:255',
            
            
            'email' => 'required|email|unique:users,email,' . $userId . ',user_id',
            
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string',
            
            'fonction' => 'nullable|in:bibliothecaire,administrateur,lecteur',
            
            
            'password' => $this->isMethod('post')
                ? 'required|min:6'
                : 'nullable|min:6',
        ];
    }

    /**
     * Messages d'erreurs personnalisés.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom complet est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];
    }
}
