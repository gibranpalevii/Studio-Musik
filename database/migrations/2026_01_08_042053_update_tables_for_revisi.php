<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Tambah Foto ke tabel STUDIOS
        if (!Schema::hasColumn('studios', 'foto')) {
            Schema::table('studios', function (Blueprint $table) {
                $table->string('foto')->nullable()->after('harga_per_jam'); 
            });
        }

        // 2. Tambah Foto ke tabel ALAT_MUSIKS
        if (!Schema::hasColumn('alat_musiks', 'foto')) {
            Schema::table('alat_musiks', function (Blueprint $table) {
                $table->string('foto')->nullable()->after('harga_sewa');
            });
        }

        // 3. Tambah Kode & Status Bayar ke tabel TRANSAKSIS
        Schema::table('transaksis', function (Blueprint $table) {
            // Cek dulu biar tidak error jika kolom sudah ada
            if (!Schema::hasColumn('transaksis', 'kode_transaksi')) {
                $table->string('kode_transaksi')->nullable()->after('id'); // Saya ubah jadi nullable dulu biar aman untuk data lama
            }
            
            if (!Schema::hasColumn('transaksis', 'status_bayar')) {
                // PERBAIKAN: Ubah 'status_pembayaran' jadi 'status_bayar'
                // Defaultnya kita samakan dengan Controller: 'Belum Lunas'
                $table->string('status_bayar')->default('Belum Lunas')->after('total_biaya'); 
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};