<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patologo extends Model
{
    protected $table = 'patologo';
    protected $primaryKey = 'idPatologo';

    public function autopsias()
    {
        return $this->hasMany(Autopsia::class, 'Patologo_idPatologo');
    }
}
