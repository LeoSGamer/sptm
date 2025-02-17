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
    Schema::create('cadaver', function (Blueprint $table) {
        $table->id('idCadaver');
        $table->string('nombre', 100);
        $table->binary('datosBiometricos');
        $table->text('objetosPersonales')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadaver');
    }
};
