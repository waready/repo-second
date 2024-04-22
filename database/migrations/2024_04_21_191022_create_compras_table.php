<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->char('dni', 30);
            $table->char("ruc", 11);
            $table->char("cci", 20);
            $table->string('num_os');
            $table->string('apellidos_nombres');
            $table->string('referencia');
            $table->string('domicilio');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');
            $table->string('celular');
            $table->string('cuadro_adq');
            $table->string('tipo_proceso');
            $table->string('num_contrato');
            $table->string('moneda');
            $table->decimal('valor_total', 10, 2); // Changed to decimal for monetary values
            $table->enum('sincronizar_pdf', ["0", "1", "2"])->default("0")->comment("0: No, 1: Si, 2: error");
            $table->string('urlpdf')->nullable();
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
        Schema::dropIfExists('compras');
    }
}