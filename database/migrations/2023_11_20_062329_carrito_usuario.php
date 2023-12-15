<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*Run the migrations.*/
    public function up()
    {
        Schema::create('carrito_usuario', function (Blueprint $table) {
            $table->id();
            $table->uuid('identificador_carrito')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('caja_id');
            $table->decimal('precio_total', 10, 2)->default(0);
            // Definición de las claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('cascade');
            $table->unsignedBigInteger('venta_id')->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->softDeletes();
            $table->timestamps();
        });
    }



    /*Reverse the migrations.*/
    public function down(): void{

      Schema::dropIfExists('carrito_usuario');

    }
  };