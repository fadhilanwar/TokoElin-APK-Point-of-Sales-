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
        Schema::create('databarang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->unique();
            $table->integer('id_jenis');
            $table->string('nama_barang')->nullable();
            $table->string('nama_jenis')->nullable();
            $table->bigInteger('harga_grosir')->nullable();
            $table->bigInteger('harga_satuan')->nullable();
            $table->integer('stok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databarang');
    }
};
