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
        Schema::create('maintenance_task_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('maintenance_tasks')->onDelete('cascade');
            $table->foreignId('checklist_id')->constrained('maintenance_checklists')->onDelete('cascade');
            $table->boolean('is_checked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['task_id', 'checklist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_task_checklists');
    }
};
