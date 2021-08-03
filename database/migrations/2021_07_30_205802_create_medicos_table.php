<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->integer('crm_numero');
            $table->char('crm_uf');

            $table->integer('cidades_id')->unsigned();
            $table->foreign('cidades_id')->references('id')->on('cidades')->onDelete('cascade');

            $table->integer('estados_id')->unsigned();
            $table->foreign('estados_id')->references('id')->on('estados')->onDelete('cascade');

            $table->string('telefone_celular');
            $table->string('telefone_fixo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}
