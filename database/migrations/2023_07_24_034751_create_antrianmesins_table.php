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
        Schema::create('antrianmesins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyekorders_id');
            $table->string('nospk')->unique();
            $table->date('tglspk');
            $table->string('namabarang');
            $table->smallInteger('qtybarang');

            $table->date('tglmhotpress')->nullable();
            $table->date('tglkhotpress')->nullable();
            $table->string('kethotpress')->nullable();

            $table->date('tglmbasic')->nullable();
            $table->date('tglkbasic')->nullable();
            $table->string('ketbasic')->nullable();

            $table->date('tglmedging')->nullable();
            $table->date('tglkedging')->nullable();
            $table->string('ketedging')->nullable();

            $table->date('tglmcnc')->nullable();
            $table->date('tglkcnc')->nullable();
            $table->string('ketcnc')->nullable();

            $table->date('tglmtukang')->nullable();
            $table->date('tglktukang')->nullable();
            $table->string('kettukang')->nullable();

            $table->date('tglmfinish')->nullable();
            $table->date('tglkfinish')->nullable();
            $table->string('ketfinish')->nullable();

            $table->timestamps();

            $table->foreign('proyekorders_id')->references('id')->on('proyekorders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrianmesins');
    }
};
