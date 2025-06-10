<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->string('provinsi')->default('Jawa Barat');
            $table->string('kabupaten')->default('Kabupaten Bogor');
        });
    }

    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropColumn(['provinsi', 'kabupaten']);
        });
    }
};
