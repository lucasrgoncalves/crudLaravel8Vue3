<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert(['nome_especialidade' =>'Acupuntura', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Anestesiologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Cancerologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Cardiologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Cirurgia Geral', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Dermatologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Endoscopia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Infectologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Neurologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Pediatria', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Pneumologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Psiquiatria', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Radioterapia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Reumatologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);

        DB::table('especialidades')->insert(['nome_especialidade' =>'Urologia', 'descricao' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text. ']);
    }
}