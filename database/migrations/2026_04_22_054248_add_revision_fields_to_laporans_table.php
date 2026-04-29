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
            $table->integer('revisi_count')->default(0)->after('completed_at');
            $table->boolean('is_accepted')->default(false)->after('revisi_count');
            $table->timestamp('accepted_at')->nullable()->after('is_accepted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['revisi_count', 'is_accepted', 'accepted_at']);
        });
    }
};
