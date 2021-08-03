<?php

namespace App\Http\Controllers;

use App\Models\Medicos;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    public function getMedicos(){
        try {
            $medicos = Medicos::with('cidademedico', 'estadomedico', 'especialidades')->get();
            $msg["status"] = "ok";
            $msg["result"] = $medicos;
            return response(json_encode($msg), 200);

        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }

    public function store(Request $request){
        try {

            $medico = new Medicos();
            $medico->nome = $request->nome;
            $medico->email = $request->email;
            $medico->crm_numero = $request->crm_numero;
            $medico->crm_uf = $request->crm_uf;
            $medico->cidades_id = $request->cidades_id;
            $medico->estados_id = $request->estados_id;
            $medico->telefone_celular = $request->telefone_celular;
            $medico->telefone_fixo = $request->telefone_fixo;

            if($medico->save()){
                $msg["status"] = "ok";
                $msg["result"] = $medico;                

                $medEspecialidade = new MedicoEspecialidadesController();
                $medEspecialidade->store($medico->id, $request->especialidade);
                return response(json_encode($msg), 200); 
            }
            
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }

    public function destroy($id){
        try {
            $medico = new Medicos();
            if($medico->destroy($id)){
                $msg["status"] = "ok";
                $msg["result"] = $medico;
    
                return response(json_encode($msg), 200);
    
            }
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }

    public function update(Request $request, $id){

        try {

            $medicoupdate = Medicos::find($id);
            $medicoupdate->nome = ($request->nome != null) ? $request->nome : $medicoupdate->nome;
            $medicoupdate->email = ($request->email != null) ? $request->email : $medicoupdate->email;
            $medicoupdate->crm_numero = ($request->crm_numero != null) ? $request->crm_numero : $medicoupdate->crm_numero;
            $medicoupdate->crm_uf = ($request->crm_uf != null) ? $request->crm_uf : $medicoupdate->crm_uf;
            $medicoupdate->cidades_id = ($request->cidades_id != null) ? $request->cidades_id : $medicoupdate->cidades_id;
            $medicoupdate->estados_id = ($request->estados_id != null) ? $request->estados_id : $medicoupdate->estados_id;
            $medicoupdate->telefone_celular = ($request->telefone_celular != null) ? $request->telefone_celular : $medicoupdate->telefone_celular;
            $medicoupdate->telefone_fixo = ($request->telefone_fixo != null) ? $request->telefone_fixo : $medicoupdate->telefone_fixo;
            if($medicoupdate->save()){
                $msg["status"] = "ok";
                $msg["result"] = $medicoupdate;      
                
                $medEspecialidade = new MedicoEspecialidadesController();
                $medEspecialidade->update($medicoupdate->id, $request->especialidade);

                return response(json_encode($msg), 200); 
            }
            
        } catch (\Throwable $th) {
            $msg["status"] = "erro";
            $msg["errors"] = $th->getMessage();
            return response(json_encode($msg), 500);
        }
    }
}
