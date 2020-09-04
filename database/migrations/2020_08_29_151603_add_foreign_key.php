<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PRODUCTO
        Schema::table('productos', function (Blueprint $table) {
            //REFERENCIA A LA TABLA TIPO_PRODUCTO
            $table->foreign('tipoProducto_id')->references('id_tipoProducto')
            ->on('tipos_productos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        //TABLA PRECIOS
        Schema::table('precios', function (Blueprint $table) {
            //REFERENCIANDO A LA TABLA PRODUCTOS
            $table->foreign('producto_id')->references('id_producto')
            ->on('productos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->primary(['producto_id']);
        });

        //TABLA PRECIOS
        Schema::table('stocks', function (Blueprint $table) {
            //REFERENCIANDO A LA TABLA PRODUCTOS
            $table->foreign('producto_id')->references('id_producto')
            ->on('productos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->primary(['producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
