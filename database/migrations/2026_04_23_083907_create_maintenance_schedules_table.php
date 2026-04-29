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
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tugas');
            $table->enum('frekuensi', ['daily', 'weekly', 'monthly']);
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->foreignId('teknisi_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->time('waktu_mulai')->nullable(); // Optional: specific start time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedules');
    }
};
