<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify ENUM to include 'reopened' status
        DB::statement("ALTER TABLE laporans MODIFY COLUMN status ENUM('pending', 'progress', 'done', 'reopened') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original ENUM
        DB::statement("ALTER TABLE laporans MODIFY COLUMN status ENUM('pending', 'progress', 'done') DEFAULT 'pending'");
    }
};
