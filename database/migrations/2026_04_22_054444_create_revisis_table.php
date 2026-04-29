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
        Schema::create('revisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained()->onDelete('cascade');
            $table->foreignId('pelapor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('revision_number');
            $table->text('alasan');
            $table->timestamp('reopened_at');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisis');
    }
};
