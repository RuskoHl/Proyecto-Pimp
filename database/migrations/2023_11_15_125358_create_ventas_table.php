<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_emision');
            $table->decimal('valor_total', 8, 2);
            $table->unsignedBigInteger('caja_id');
            $table->unsignedBigInteger('user_id');
            $table->text('contenido')->nullable(); // Corregido a 'contenido'
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->string('estado')->nullable();

            $table->softDeletes();
            $table->timestamps();
        
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventas');
    }
};
