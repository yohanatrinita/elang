<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('semester_reports', function (Blueprint $table) {
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('semester')->nullable();
            $table->string('tahun')->nullable();
            $table->string('status_dokumen')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('semester_reports', function (Blueprint $table) {
            $table->dropColumn([
                'nama_perusahaan',
                'alamat',
                'penanggung_jawab',
                'jenis_usaha',
                'semester',
                'tahun',
                'status_dokumen',
                'tanggal_diterima',
                'catatan'
            ]);
        });
    }

};
