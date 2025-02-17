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
    Schema::create('informe', function (Blueprint $table) {
        $table->id('idInforme');
        $table->date('fechaInforme');
        $table->text('contenido');
        $table->unsignedBigInteger('Autopsia_idAutopsia')->unique();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe');
    }
};
