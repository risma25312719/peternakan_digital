<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemberianPakanTable extends Migration
{
    public function up()
    {
        Schema::create('pemberian_pakan', function (Blueprint $table) {
            $table->bigIncrements('pemberian_pakan_id');
            $table->foreignId('ternak_id')
                  ->constrained('data_ternak', 'ternak_id')
                  ->cascadeOnDelete();
            $table->foreignId('pakan_id')
                  ->constrained('data_pakan', 'data_pakan_id')->cascadeOnDelete();
            $table->date('tanggal');
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemberian_pakan');
    }
}