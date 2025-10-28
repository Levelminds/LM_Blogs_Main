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
        Schema::table('site_visits', function (Blueprint $table) {
            $table->string('fingerprint', 100)->nullable()->after('referrer');
            $table->date('visited_date')->nullable()->after('visited_at');

            $table->index('fingerprint');
            $table->unique(['fingerprint', 'path', 'visited_date'], 'unique_visit_per_device');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_visits', function (Blueprint $table) {
            $table->dropUnique('unique_visit_per_device');
            $table->dropIndex(['fingerprint']);
            $table->dropColumn(['fingerprint', 'visited_date']);
        });
    }
};
