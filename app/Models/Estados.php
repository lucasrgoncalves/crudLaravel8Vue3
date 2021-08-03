<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;

    public function cidades(){
        return $this->hasMany(Cidades::class);
    }

    public function medico() {
        return $this->hasOne(Medicos::class);
    }



}
