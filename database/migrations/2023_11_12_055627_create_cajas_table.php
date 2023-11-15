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
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->DateTime('fecha_apertura');
            $table->Decimal('monto_inicial');
            $table->DateTime('fecha_cierre')->nullable();
            $table->Decimal('monto_final')->nullable();
            $table->Decimal('cantidad_ventas')->nullable();
            $table->Boolean('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
