<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTernakTable extends Migration
{
    public function up()
    {
        Schema::create('data_ternak', function (Blueprint $table) {
            $table->id('ternak_id');
            $table->string('kode_ternak')->unique();
            $table->enum('jenis_hewan', ['sapi', 'kambing', 'ayam']);
            $table->enum('jenis_kelamin', ['jantan', 'betina']);
            $table->date('tanggal_masuk');
            $table->enum('status', ['aktif', 'dijual', 'mati'])->default('aktif');
            $table->foreignId('kandang_id')
                  ->nullable()
                  ->constrained('kandang', 'kandang_id')
                  ->nullOnDelete();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_ternak');
    }
}