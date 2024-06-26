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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->unique();
            $table->date('tgl_transaksi')->nullable();
            $table->string('kasir')->nullable();
            $table->bigInteger('total_bayar')->nullable();
            $table->bigInteger('uang_diterima')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->string('nama_pembeli')->nullable();
            $table->bigInteger('sisa_bayar')->nullable();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
