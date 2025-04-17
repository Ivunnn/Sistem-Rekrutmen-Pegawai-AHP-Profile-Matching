<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AhpPerhitungans extends Migration
{
    public function up()
    {
        Schema::create('ahp_perhitungans', function (Blueprint $table) {
            $table->id('id_perhitungan');
            $table->string('nama_perhitungan');
            $table->text('detail')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_konsisten')->default(false);
            $table->float('lambda_max')->nullable();
            $table->float('consistency_index')->nullable();
            $table->float('consistency_ratio')->nullable();
            $table->boolean('is_created_by_admin')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ahp_perhitungans');
    }
}
