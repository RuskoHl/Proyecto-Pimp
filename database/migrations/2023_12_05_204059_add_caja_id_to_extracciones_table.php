<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCajaIdToExtraccionesTable extends Migration
{
    public function up()
    {
        Schema::table('extracciones', function (Blueprint $table) {
            $table->foreignId('caja_id')->constrained('cajas');
        });
    }

    public function down()
    {
        Schema::table('extracciones', function (Blueprint $table) {
            $table->dropForeign(['caja_id']);
            $table->dropColumn('caja_id');
        });
    }
}

