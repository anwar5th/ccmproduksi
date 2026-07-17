<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel mesins menyimpan daftar mesin produksi.
     * Tabel antrians menyimpan antrian pengerjaan tiap SPK di tiap mesin.
     *
     * Relasi:
     *   antrians.antrianmesin_id  →  antrianmesins.id
     *   antrians.mesin_id         →  mesins.id
     */
    public function up(): void
    {
        // 1. Buat tabel mesins
        Schema::create('mesins', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mesin', 50)->comment('Nama mesin produksi');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->comment('Status aktif/nonaktif mesin');
            $table->timestamps();
        });

        // 2. Insert data mesin default
        DB::table('mesins')->insert([
            ['nama_mesin' => 'Hot Press',       'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'Running Saw',     'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'CNC 5 Axis',      'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'CNC 4 Axis',      'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'Boring Vertikal', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'CNC Router',      'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'Rakit',           'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mesin' => 'Finishing',       'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Buat tabel antrians
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();

            // Relasi ke SPK dan mesin
            $table->foreignId('antrianmesin_id')
                  ->constrained('antrianmesins')
                  ->onDelete('cascade')
                  ->comment('ID SPK terkait');

            $table->foreignId('mesin_id')
                  ->constrained('mesins')
                  ->onDelete('cascade')
                  ->comment('ID mesin terkait');

            // Data antrian
            $table->integer('nomor_antrian')->default(0)->comment('Nomor urut antrian di mesin ini');
            $table->timestamp('waktu_masuk')->nullable()->comment('Tanggal & jam SPK masuk ke mesin (Tanggal Masuk)');
            $table->timestamp('waktu_selesai')->nullable()->comment('Tanggal & jam SPK keluar dari mesin (Tanggal Keluar)');
            $table->enum('status_antrian', ['menunggu', 'diproses', 'selesai'])
                  ->default('menunggu')
                  ->comment('Status pengerjaan: menunggu / diproses / selesai');
            $table->text('keterangan')->nullable()->comment('Catatan atau keterangan tambahan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
        Schema::dropIfExists('mesins');
    }
};
