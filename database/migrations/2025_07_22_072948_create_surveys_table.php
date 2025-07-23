<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedTinyInteger('kualitas_produk');
            $table->unsignedTinyInteger('pelayanan');
            $table->unsignedTinyInteger('pengiriman');
            $table->unsignedTinyInteger('kemudahan_transaksi');
            $table->unsignedTinyInteger('harga_nilai');
            $table->unsignedTinyInteger('after_sales');
            $table->unsignedTinyInteger('kepuasan_umum');
            $table->unsignedTinyInteger('nps');
            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
