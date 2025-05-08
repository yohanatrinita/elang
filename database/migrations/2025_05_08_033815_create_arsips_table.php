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
    Schema::create('arsip', function (Blueprint $table) {
        $table->id();
        $table->string('pelaku_usaha');
        $table->string('jenis_usaha');
        $table->string('tanggal_pengawasan');
        $table->string('bulan');
        $table->year('tahun');
        $table->string('dokumen_lingkungan');
        $table->string('ppa');
        $table->string('ppu');
        $table->string('plb3');
        $table->string('rekomendasi');
        $table->string('tindak_lanjut');
        $table->string('file_pdf')->nullable();
        $table->timestamps();
    });
}

};
