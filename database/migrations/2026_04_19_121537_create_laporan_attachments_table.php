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
        Schema::create('laporan_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporans')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type', 50);
            $table->integer('file_size');
            $table->enum('uploaded_by', ['pelapor', 'teknisi'])->default('pelapor');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_attachments');
    }
};
