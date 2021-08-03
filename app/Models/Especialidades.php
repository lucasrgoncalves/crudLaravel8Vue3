<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    use HasFactory;

    public function medicos() {
        return $this->belongsToMany(Medicos::class, 'medico_especialidades', 'id', 'id');
    }
}
