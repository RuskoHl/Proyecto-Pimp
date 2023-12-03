<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->DateTime('fecha_apertura');
            $table->Decimal('monto_inicial');
            $table->DateTime('fecha_cierre')->nullable();
            $table->Decimal('monto_final')->nullable();
            $table->Decimal('cantidad_ventas')->nullable();
            $table->Boolean('status');
            $table->decimal('extraccion', 10, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
};
