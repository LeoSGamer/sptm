<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    protected $table = 'historial_clinicos';
    protected $primaryKey = 'idHistorial';

    public function cadaver()
    {
        return $this->belongsTo(Cadaver::class, 'Cadaver_idCadaver');
    }
}
