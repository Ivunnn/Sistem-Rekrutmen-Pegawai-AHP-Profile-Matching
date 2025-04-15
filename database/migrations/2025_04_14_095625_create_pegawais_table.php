<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('no_peserta')->unique();
            $table->string('name');
            $table->date('tanggal'); // Tanggal lahir / masuk kerja bisa disesuaikan
            $table->string('jabatan');
            $table->string('bagian');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
