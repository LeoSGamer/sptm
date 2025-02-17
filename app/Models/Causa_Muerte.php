<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Causa_Muerte extends Model
{
    protected $table = 'causa_muerte';
    protected $primaryKey = 'idCausaMuerte';

    public function autopsia()
    {
        return $this->belongsTo(Autopsia::class, 'Autopsia_idAutopsia');
    }
}
