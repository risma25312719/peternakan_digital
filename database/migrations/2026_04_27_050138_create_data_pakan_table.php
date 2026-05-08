<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPakanTable extends Migration
{
    public function up()
    {
        Schema::create('data_pakan', function (Blueprint $table) {
            $table->bigIncrements('data_pakan_id');
            $table->string('nama_pakan', 50);
            $table->decimal('stok', 10, 2)->default(0.00);
            $table->string('satuan', 30);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_pakan');
    }
}