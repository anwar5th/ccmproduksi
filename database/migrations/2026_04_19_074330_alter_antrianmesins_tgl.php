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
        // Change several date columns to datetime so they can store time as well as date.
        // NOTE: This requires the doctrine/dbal package to be installed when running migrations
        // (composer require doctrine/dbal) if you need to change column types on existing tables.
        Schema::table('antrianmesins', function (Blueprint $table) {
            $table->dateTime('tglspk')->nullable()->change();

            $table->dateTime('tglmhotpress')->nullable()->change();
            $table->dateTime('tglkhotpress')->nullable()->change();

            $table->dateTime('tglmbasic')->nullable()->change();
            $table->dateTime('tglkbasic')->nullable()->change();

            $table->dateTime('tglmedging')->nullable()->change();
            $table->dateTime('tglkedging')->nullable()->change();

            $table->dateTime('tglmcnc')->nullable()->change();
            $table->dateTime('tglkcnc')->nullable()->change();

            $table->dateTime('tglmtukang')->nullable()->change();
            $table->dateTime('tglktukang')->nullable()->change();

            $table->dateTime('tglmfinish')->nullable()->change();
            $table->dateTime('tglkfinish')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert datetime columns back to date only.
        Schema::table('antrianmesins', function (Blueprint $table) {
            $table->date('tglspk')->nullable()->change();

            $table->date('tglmhotpress')->nullable()->change();
            $table->date('tglkhotpress')->nullable()->change();

            $table->date('tglmbasic')->nullable()->change();
            $table->date('tglkbasic')->nullable()->change();

            $table->date('tglmedging')->nullable()->change();
            $table->date('tglkedging')->nullable()->change();

            $table->date('tglmcnc')->nullable()->change();
            $table->date('tglkcnc')->nullable()->change();

            $table->date('tglmtukang')->nullable()->change();
            $table->date('tglktukang')->nullable()->change();

            $table->date('tglmfinish')->nullable()->change();
            $table->date('tglkfinish')->nullable()->change();
        });
    }
};
