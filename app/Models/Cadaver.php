<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadaver extends Model
{
    protected $table = 'cadaver';
    protected $primaryKey = 'idCadaver';

    public function autopsias()
    {
        return $this->hasMany(Autopsia::class, 'Cadaver_idCadaver');
    }

    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'Cadaver_idCadaver');
    }

    public function historialesClinicos()
    {
        return $this->hasMany(HistorialClinico::class, 'Cadaver_idCadaver');
    }
}
