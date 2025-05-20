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
            if (!Schema::hasColumn('arsips', 'file_pdf_path')) {
                $table->string('file_pdf_path')->nullable()->after('tindak_lanjut');
            }

            if (!Schema::hasColumn('arsips', 'file_pdf_name')) {
                $table->string('file_pdf_name')->nullable()->after('file_pdf_path');
            }
        });
    }



};
