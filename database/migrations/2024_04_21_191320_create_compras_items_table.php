<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_items', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion'); 
            $table->string("descripcion_general"); 
            $table->string('codigo');
            $table->string('pedido');
            $table->string('unidad_medida');
            $table->unsignedBigInteger('compras_id');
            $table->foreign('compras_id')->references('id')->on('compras');
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
        Schema::dropIfExists('compras_items');
    }
}
