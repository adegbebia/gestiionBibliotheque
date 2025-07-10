<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Livre extends Model
{
    //

    protected $primaryKey='livre_id';

        protected $fillable = [
        'titre',
        'auteur',
        'resume',
        'pdf_url',
        'isbn',
        'disponible',
        'quantite',
    ];


    public function livres_emprunts(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'livre_emprunter', 'livre_id', 'emprint_id');
        }
}
