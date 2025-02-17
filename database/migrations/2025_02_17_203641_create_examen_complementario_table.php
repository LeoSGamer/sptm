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
    Schema::create('examen_complementario', function (Blueprint $table) {
        $table->id('idExamenComplementario');
        $table->string('laboratorio', 100);
        $table->string('tipoExamen', 100);
        $table->text('resultados');
        $table->unsignedBigInteger('Autopsia_idAutopsia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_complementario');
    }
};
