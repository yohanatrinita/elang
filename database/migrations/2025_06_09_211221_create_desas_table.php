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
    Schema::create('desas', function (Blueprint $table) {
        $table->id();
        $table->string('nama'); // Nama desa
        $table->unsignedBigInteger('kecamatan_id'); // Relasi ke kecamatan
        $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
