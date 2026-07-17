<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel antrianmesins menyimpan data SPK (Surat Perintah Kerja).
     * Setiap SPK terkait ke satu PO (proyekorders) dan memiliki
     * banyak antrian mesin (antrians).
     */
    public function up(): void
    {
        Schema::create('antrianmesins', function (Blueprint $table) {
            $table->id();

            // Relasi ke PO
            $table->foreignId('proyekorders_id')
                  ->constrained('proyekorders')
                  ->onDelete('cascade')
                  ->comment('ID Proyek Order terkait');

            // Identitas SPK
            $table->string('nospk')->unique()->comment('Nomor SPK, harus unik');
            $table->dateTime('tglspk')->nullable()->comment('Tanggal terbit SPK');
            $table->date('deadline')->nullable()->comment('Tanggal deadline pengerjaan');
            $table->integer('prioritas')->nullable()->comment('Prioritas pengerjaan (angka kecil = lebih prioritas)');

            // Detail barang
            $table->string('namabarang')->comment('Nama barang / produk yang dikerjakan');
            $table->smallInteger('qtybarang')->default(0)->comment('Jumlah / kuantitas barang');

            // Status penyelesaian SPK
            $table->dateTime('tglcompleted')->nullable()->comment('Tanggal SPK dinyatakan selesai penuh');

            // Audit trail
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir mengubah');

            $table->timestamps();
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
