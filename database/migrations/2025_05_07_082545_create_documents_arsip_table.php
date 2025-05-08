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
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('file_path');
        $table->string('category');
        $table->timestamp('uploaded_at')->nullable();
        $table->timestamps();
    });
}

};
