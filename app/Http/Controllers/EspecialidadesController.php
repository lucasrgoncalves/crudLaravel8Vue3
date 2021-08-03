<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    public function getEspecialidades(){
        try {
            $especialidades = Especialidades::all();    
            $msg["status"] = "ok";
            $msg["result"] = $especialidades;
            return response(json_encode($msg), 200);
    
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }

    public function store(Request $request){
        try {
            $especialidade = new Especialidades();
            $especialidade->nome_especialidade = $request->nome_especialidade;
            $especialidade->descricao = $request->descricao;

            if($especialidade->save()){
                $msg["status"] = "ok";
                $msg["result"] = $especialidade;
                return response(json_encode($msg), 200); 
            }
            
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }    
}
