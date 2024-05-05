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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->unique();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('harga_grosir')->nullable();
            $table->bigInteger('harga_satuan')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->bigInteger('laba')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
