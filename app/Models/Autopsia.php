<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autopsia extends Model
{
    protected $table = 'autopsia';
    protected $primaryKey = 'idAutopsia';

    public function patologo()
    {
        return $this->belongsTo(Patologo::class, 'Patologo_idPatologo');
    }

    public function cadaver()
    {
        return $this->belongsTo(Cadaver::class, 'Cadaver_idCadaver');
    }

    public function causa_Muerte()
    {
        return $this->hasOne(Causa_Muerte::class, 'Autopsia_idAutopsia');
    }

    public function informe()
    {
        return $this->hasOne(Informe::class, 'Autopsia_idAutopsia');
    }

    public function examenesComplementario()
    {
        return $this->hasMany(ExamenComplementario::class, 'Autopsia_idAutopsia');
    }
}
