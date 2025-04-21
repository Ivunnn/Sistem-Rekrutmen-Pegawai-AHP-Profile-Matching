<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiIdealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ideals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->float('nilai_ideal');
            $table->enum('tipe_faktor', ['core', 'secondary']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_ideals');
    }

}
