<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenComplementario extends Model
{
    protected $table = 'examen_complementario';
    protected $primaryKey = 'idExamenComplementario';

    public function autopsia()
    {
        return $this->belongsTo(Autopsia::class, 'Autopsia_idAutopsia');
    }
}
