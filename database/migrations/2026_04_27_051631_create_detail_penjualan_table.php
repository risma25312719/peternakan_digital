<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->bigIncrements('detail_id');
            $table->foreignId('penjualan_id')
                  ->constrained('penjualan', 'penjualan_id')
                  ->cascadeOnDelete();
            $table->foreignId('ternak_id')
                  ->constrained('data_ternak', 'ternak_id')
                  ->restrictOnDelete(); // atau cascadeOnDelete() sesuai kebutuhan
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
}