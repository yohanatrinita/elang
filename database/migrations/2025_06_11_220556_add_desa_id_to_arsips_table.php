<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->foreignId('desa_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });
    }
};
