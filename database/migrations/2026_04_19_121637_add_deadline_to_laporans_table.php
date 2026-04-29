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
        Schema::table('laporans', function (Blueprint $table) {
            $table->timestamp('deadline')->nullable()->after('status');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->after('deadline');
            $table->boolean('is_overdue')->default(false)->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'priority', 'is_overdue']);
        });
    }
};
