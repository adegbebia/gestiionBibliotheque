<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecteur extends Model
{
    protected $primaryKey = 'lecteur_id';  

    

    protected $fillable = [
        'user_id',
        'est_abonne',
    ];

    protected $casts = [
        'est_abonne' => 'boolean',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


 
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class, 'lecteur_id', 'lecteur_id');
    }
}
