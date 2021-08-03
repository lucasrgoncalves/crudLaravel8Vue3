<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    use HasFactory;

    public function estadomedico() {
        return $this->belongsTo(Estados::class, 'estados_id', 'id');
    }

    public function cidademedico() {
        return $this->belongsTo(Cidades::class, 'cidades_id', 'id');
    }

    public function especialidades() {
        return $this->belongsToMany(Especialidades::class, 'medico_especialidades', 'id', 'id');
    }

}
