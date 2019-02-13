<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
             $table->increments('id');
             $table->string('nombre');
            $table->string('marca');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->float('preciounitario');
            $table->integer('stockTotal');
            $table->float('preciocompra');
            $table->date('fechavence')->nullable();
            $table->date('fechaReg');
            $table->integer('id_cat')->unsigned()->nullable();
            $table->integer('id_proveedor')->unsigned()->nullable();
            $table->integer('id_estante')->unsigned()->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->foreign('id_cat')
                  ->references('id')->on('categories')
                  ->onDelete('no action')
                  ->onUpdate('cascade');
            $table->foreign('id_proveedor')
                  ->references('id')->on('proveedors')
                  ->onDelete('no action')
                  ->onUpdate('cascade');
            $table->foreign('id_estante')
                  ->references('id')->on('estantes')
                  ->onDelete('no action')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
