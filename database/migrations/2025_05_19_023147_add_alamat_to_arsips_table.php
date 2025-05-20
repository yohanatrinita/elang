<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->string('alamat')->after('pelaku_usaha');
            $table->string('jenis_dokumen_lingkungan')->nullable()->after('jenis_usaha');
        });
    }

    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('jenis_dokumen_lingkungan');
        });
    }

};
