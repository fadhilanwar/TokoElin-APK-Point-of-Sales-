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
        Schema::create('pasok_detail', function (Blueprint $table) {
            // $table->id();
            $table->string('id_pasok');
            $table->string('id_barang');
            $table->string('nama_barang')->nullable();
            $table->bigInteger('harga_grosir')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasok_detail');
    }
};
