<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id(); // Ini otomatis jadi id (primary key)
            
            // Foreign key ke tabel pelanggan
            // (Pastikan tipe datanya sama dengan id di tabel pelanggan, biasanya unsignedBigInteger)
            $table->unsignedBigInteger('id_pelanggan'); 
            
            $table->string('jenis_transaksi'); // Sewa Studio / Sewa Alat
            $table->string('nama_item');       // Nama Studio A / Gitar Fender
            $table->date('tanggal');
            $table->integer('durasi');         // Berapa jam / unit
            $table->integer('total_biaya');
            $table->string('status')->default('Proses'); // Default status 'Proses'
            
            $table->timestamps(); // Created_at & Updated_at
            
            // (Opsional) Menghubungkan id_pelanggan agar tidak error
            // $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};