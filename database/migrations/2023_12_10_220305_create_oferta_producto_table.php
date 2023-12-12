<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertaProductoTable extends Migration
{
    public function up()
    {
        Schema::create('oferta_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oferta_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            // Puedes agregar otros campos según sea necesario
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('oferta_producto');
    }
}
