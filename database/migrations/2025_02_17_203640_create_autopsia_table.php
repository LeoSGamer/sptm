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
    Schema::create('autopsia', function (Blueprint $table) {
        $table->id('idAutopsia');
        $table->dateTime('fechaAutopsia');
        $table->mediumText('procedimiento');
        $table->mediumText('hallazgos');
        $table->unsignedBigInteger('Patologo_idPatologo');
        $table->unsignedBigInteger('Cadaver_idCadaver');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autopsia');
    }
};
