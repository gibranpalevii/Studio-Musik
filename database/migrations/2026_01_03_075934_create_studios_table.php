<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id('id_studio'); 
            $table->string('nama_studio'); 
            $table->integer('harga_per_jam'); 
            $table->enum('status', ['Tersedia', 'Maintenance', 'Dipakai'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('studios');
    }
};