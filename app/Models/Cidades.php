<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    use HasFactory;

    public function estado(){
        return $this->belongsTo(Estados::class, 'estados_id', 'id');
    }

    public function medico() {
        return $this->hasOne(Medicos::class);
    }

}
