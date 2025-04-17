<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AhpDetailBobotKriteria extends Migration
{
    public function up()
    {
        Schema::create('ahp_detail_bobot_kriteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->unsignedBigInteger('kriteria_id');
            $table->float('bobot');
            $table->timestamps();
        
            $table->foreign('id_perhitungan')->references('id_perhitungan')->on('ahp_perhitungans')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ahp_detail_bobot_kriteria');
    }
}
