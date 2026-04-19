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
        // Add `role` column after `email` on `users` table.
        // NOTE: assumption — default set to 1 (Engineering & Estimator). Change default if you prefer.
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->after('email')->default(1)->comment('1: Engineering & Estimator, 2: Admin Produksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
