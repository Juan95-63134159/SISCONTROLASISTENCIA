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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            // campo para almacena la llave foranea de la tabla miembro
            $table->biginteger('miembro_id')->unsigned();
            $table->timestamps();
            // para relacionar la tabla asistencia y miembros
            $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
