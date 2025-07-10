<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $primaryKey = 'user_id';

    

    
    protected $table = 'users';

    
    protected $fillable = [
        'name',
        'email',
        'fonction',
        'password',
        'date_naissance',
        'telephone',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'date_naissance' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

   
    /**
     * 
     */
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class, 'user_id', 'user_id');
    }

    /**
     * 
     */
    public function lecteur(): HasOne
    {
        return $this->hasOne(Lecteur::class, 'user_id', 'user_id');
    }
}
