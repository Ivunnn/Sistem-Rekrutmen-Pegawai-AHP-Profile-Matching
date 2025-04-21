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
            $table->string('name');
            $table->string('bagian_dilamar');
            $table->string('pendidikan')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->string('sertifikasi_pendukung')->nullable();
            $table->string('kemampuan')->nullable();
            $table->string('cv')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}