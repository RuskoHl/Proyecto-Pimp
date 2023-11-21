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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 15)->unique()->index();
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->string('domicilio');
            $table->unsignedBigInteger('telefono');
            $table->string('correo')->unique();
            $table->softDeletes(); // Agregar esta línea para habilitar soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

