<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres')->nullable();
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->enum('genero', ['hombre','mujer'])->nullable();
            $table->string('celular')->nullable();
            $table->string('facebook')->nullable();
            $table->unsignedSmallInteger('edad')->defualt(0);
            $table->date('nacimiento')->nullable();
            $table->date('fecha_inscripcion');
            //$table->char('mes_insc', 2);
            //$table->char('dia_insc', 2);
            $table->enum('estatus', ['corriente','vencido']);

            $table->unsignedTinyInteger('activo')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
