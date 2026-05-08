<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanTable extends Migration
{
    public function up()
    {
        Schema::create('kesehatan', function (Blueprint $table) {
            $table->bigIncrements('kesehatan_id');
            // Hanya satu kali definisi foreignId
            $table->foreignId('ternak_id')
                  ->constrained('data_ternak', 'ternak_id')
                  ->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('kondisi', 50);
            $table->text('tindakan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kesehatan');
    }
}