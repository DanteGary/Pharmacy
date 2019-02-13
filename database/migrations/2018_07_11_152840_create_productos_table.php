<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
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

            // $table->integer('id_cap')->unsigned();
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
                  

            // $table->foreign('id_cap')
            //       ->references('id')->on('capacidads')
            //       ->onDelete('cascade')
            //       ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
