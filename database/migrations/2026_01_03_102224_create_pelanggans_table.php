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
    Schema::create('pelanggans', function (Blueprint $table) {
        $table->id('id_pelanggan'); // Kita namakan id_pelanggan biar jelas
        $table->string('nama_pelanggan');
        $table->string('no_hp');
        $table->text('alamat')->nullable(); // nullable artinya boleh dikosongkan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
