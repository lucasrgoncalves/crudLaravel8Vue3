<?php

namespace App\Http\Controllers;

use App\Models\Estados;

class EstadosController extends Controller
{
    public function getEstados(){
        try {
            $estados = Estados::all();
            $msg["status"] = "ok";
            $msg["result"] = $estados;
            return response(json_encode($msg), 200);

        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }
}
