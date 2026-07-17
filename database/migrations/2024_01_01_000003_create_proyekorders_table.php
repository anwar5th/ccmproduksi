<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Tabel proyekorders menyimpan data Proyek Order (PO).
     * Setiap PO dapat memiliki banyak SPK (antrianmesins).
     */
    public function up(): void
    {
        Schema::create('proyekorders', function (Blueprint $table) {
            $table->id();
            $table->string('kodepo')->unique()->comment('Kode unik Proyek Order');
            $table->string('namaproyek')->comment('Nama proyek / customer');
            $table->dateTime('tglpo')->nullable()->comment('Tanggal Proyek Order diterima');
            $table->text('keteranganpoitem')->comment('List item / keterangan isi PO');
            $table->string('dimensi')->nullable()->comment('Dimensi produk (opsional)');
            $table->string('drawing_path')->nullable()->comment('Path file drawing/PDF (storage/public)');
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
