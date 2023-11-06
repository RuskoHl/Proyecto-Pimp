<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio');
            $table->string('imagen', 100);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('vendedor_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('vendedor_id')->references('id')->on('users');
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
