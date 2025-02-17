<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    protected $table = 'muestra';
    protected $primaryKey = 'idMuestra';

    public function cadaver()
    {
        return $this->belongsTo(Cadaver::class, 'Cadaver_idCadaver');
    }
}
