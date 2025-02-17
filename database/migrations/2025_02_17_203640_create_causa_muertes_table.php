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
    Schema::create('causa_muerte', function (Blueprint $table) {
        $table->id('idCausaMuerte');
        $table->string('descripcion', 255);
        $table->unsignedBigInteger('Autopsia_idAutopsia')->unique();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causa_muertes');
    }
};
