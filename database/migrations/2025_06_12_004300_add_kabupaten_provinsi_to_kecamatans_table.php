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
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->dropColumn(['kabupaten', 'provinsi']);
        });
    }

};
