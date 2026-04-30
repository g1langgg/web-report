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
        DB::statement("ALTER TABLE laporan_histories MODIFY COLUMN action ENUM('created', 'updated', 'status_changed', 'assigned', 'completed', 'file_uploaded', 'comment_added', 'deleted', 'reopened', 'accepted', 'progress_updated')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE laporan_histories MODIFY COLUMN action ENUM('created', 'updated', 'status_changed', 'assigned', 'completed', 'file_uploaded', 'comment_added', 'deleted', 'reopened', 'accepted')");
    }
};
