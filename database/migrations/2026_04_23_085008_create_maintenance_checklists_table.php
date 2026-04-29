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
        Schema::create('maintenance_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('maintenance_schedules')->onDelete('cascade');
            $table->string('item_name'); // e.g. "Tekanan air normal"
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0); // For ordering checklist items
            $table->boolean('is_required')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_checklists');
    }
};
