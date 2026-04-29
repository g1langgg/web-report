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
        Schema::create('maintenance_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('maintenance_schedules')->onDelete('cascade');
            $table->date('tanggal_jadwal');
            $table->enum('status', ['pending', 'ongoing', 'completed', 'missed'])->default('pending');
            $table->enum('result_status', ['normal', 'need_repair', 'urgent'])->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('report_id')->nullable()->constrained('laporans')->onDelete('set null');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_tasks');
    }
};
