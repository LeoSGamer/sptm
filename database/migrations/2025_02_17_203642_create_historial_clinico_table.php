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
    Schema::create('historial_clinico', function (Blueprint $table) {
        $table->id('idHistorial');
        $table->string('diagonosticosPreexistentes', 255);
        $table->string('tratamientos', 255);
        $table->unsignedBigInteger('Cadaver_idCadaver');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinico');
    }
};
