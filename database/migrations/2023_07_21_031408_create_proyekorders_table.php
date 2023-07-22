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
        Schema::create('proyekorders', function (Blueprint $table) {
            $table->id();
            $table->string('kodepo')->unique();
            $table->string('namaproyek');
            $table->date('tglpo');
            $table->text('keteranganpoitem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyekorders');
    }
};
