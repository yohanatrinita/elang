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
        Schema::table('arsips', function (Blueprint $table) {
            $table->string('file_pdf_path')->nullable();
            $table->string('file_pdf_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropColumn(['file_pdf_path', 'file_pdf_name']);
        });
    }

};
