<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa',255)->comment('Placa');
            $table->unsignedBigInteger('marca_id')->comment('Marca');
            $table->unsignedBigInteger('modelo_id')->comment('Modelo');
            $table->integer('ano')->comment('Año');
            $table->string('color',255)->comment('Color');
            $table->unsignedBigInteger('propietario_id')->comment('Propietario');
            $table->text('observaciones')->comment('Observaciones');
            $table->date('fecha_registro')->nullable()->comment('Fecha de registro');
            //Datos de auditoria
            $table->timestamp('fechacreacion')->nullable()->default(null);
            $table->integer('usuariocreacion');
            $table->timestamp('fechamodificacion')->nullable()->default(null);
            $table->integer('usuariomodificacion');
            $table->string('ipcreacion',255);
            $table->string('ipmodificacion',255);
            //foriengn key
            $table->foreign('marca_id')->references('id')->on('marca')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('propietario_id')->references('id')->on('propietario')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo');
    }
}
