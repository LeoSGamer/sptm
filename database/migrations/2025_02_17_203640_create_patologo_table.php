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
    Schema::create('patologo', function (Blueprint $table) {
        $table->id('idPatologo');
        $table->string('nombre', 255)->nullable(false);
        $table->string('especialidad', 255)->nullable();
        $table->text('informacionContacto')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patologo');
    }
};
