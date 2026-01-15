<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alat_musiks', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('nama_alat');
            $table->string('kondisi');
            $table->integer('harga_sewa');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alat_musiks');
    }
};