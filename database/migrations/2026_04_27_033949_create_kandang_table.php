<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandangTable extends Migration
{
    public function up()
    {
        Schema::create('kandang', function (Blueprint $table) {
            $table->id('kandang_id');
            $table->string('nama_kandang');
            $table->integer('kapasitas')->default(0);
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kandang');
    }
}