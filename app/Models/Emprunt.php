<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Emprunt extends Model
{
    protected $primaryKey = 'emprunt_id';

    protected $fillable = [
        'date_debut',
        'date_retour',
        'lecteur_id',
    ];

    protected $dates = ['date_debut', 'date_retour'];

    public function lecteur(): BelongsTo
    {
        return $this->belongsTo(Lecteur::class, 'lecteur_id', 'lecteur_id');
    }

   
    public function livres(): BelongsToMany
    {
        return $this->belongsToMany(Livre::class, 'livre_emprunter', 'emprunt_id', 'livre_id');
    }
    
}
