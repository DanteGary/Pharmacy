<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned()->nullable();
            $table->date('fecha');
            $table->integer('cantidad');
            $table->integer('id_user')->unsigned()->nullable();
            $table->integer('estado');
            $table->integer('id_client')->unsigned();
            $table->timestamps();

            $table->foreign('id_client')
                    ->references('id')->on('clients')
                  ->onDelete('no action')
                    ->onUpdate('cascade');

            $table->foreign('id_producto')
                    ->references('id')->on('productos')
                  ->onDelete('no action')
                    ->onUpdate('cascade');

            $table->foreign('id_user')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('detalle_ventas');
    }
}
