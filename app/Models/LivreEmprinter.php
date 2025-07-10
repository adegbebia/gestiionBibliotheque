<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LivreEmprinter extends Pivot
{
    protected $primaryKey=['livre_id','emprunt_id'];
}
