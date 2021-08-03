<?php

namespace App\Http\Controllers;

use App\Models\MedicoEspecialidades;

class MedicoEspecialidadesController extends Controller
{
    public function store($idmedico, $especialidade){
        $medEspecialidade = new MedicoEspecialidades();
        $medEspecialidade->medicos_id = $idmedico;
        $medEspecialidade->especialidades_id = $especialidade;
        $medEspecialidade->save();        
    }

    public function update($idmedico, $especialidade){
        $medico = MedicoEspecialidades::where('medicos_id', '=', $idmedico)->first();
        
        if($especialidade != $medico->especialidades_id){
            $medico->especialidades_id = $especialidade;
            $medico->save();
        }
    }
}
