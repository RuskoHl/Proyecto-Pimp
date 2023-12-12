<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto_descuento', 10, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->string('titulo');
            $table->text('descripcion');
            $table->Boolean('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
