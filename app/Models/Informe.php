<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $table = 'informe';
    protected $primaryKey = 'idInforme';

    public function autopsia()
    {
        return $this->belongsTo(Autopsia::class, 'Autopsia_idAutopsia');
    }
}
