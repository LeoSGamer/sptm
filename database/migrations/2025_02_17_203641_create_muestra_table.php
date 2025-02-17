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
    Schema::create('muestra', function (Blueprint $table) {
        $table->id('idMuestra');
        $table->string('tipoMuestra', 100);
        $table->dateTime('fechaToma');
        $table->text('resultados');
        $table->unsignedBigInteger('Cadaver_idCadaver');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestra');
    }
};
