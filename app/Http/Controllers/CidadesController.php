<?php

namespace App\Http\Controllers;

use App\Models\Cidades;

class CidadesController extends Controller
{
    public function getCidades(){
        try {
            $cidades = Cidades::with('estado')->get();

            $msg["status"] = "ok";
            $msg["result"] = $cidades;
            return response(json_encode($msg), 200);

        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }

    public function getCidadesPorEstado($idestado){        
        try {
            $nome_cid = Cidades::where('estados_id', '=', $idestado)->get();
            $msg["status"] = "ok";
            $msg["result"] = $nome_cid;
            return response(json_encode($msg), 200);
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }        
    }
}
