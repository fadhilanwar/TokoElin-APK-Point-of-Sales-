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
        Schema::create('pasok_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_pasok');
            $table->string('supplier_tujuan');
            $table->date('tgl_transaksi')->nullable();
            $table->bigInteger('total_bayar')->nullable();
            $table->bigInteger('uang_keluar')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasok_transaksi');
    }
};
