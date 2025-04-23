<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileMatchingDetailScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_matching_detail_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained('profile_matching_results')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->float('gap');
            $table->float('bobot_gap');
            $table->float('nilai_bobot');
            $table->enum('tipe_faktor', ['CF', 'SF']);
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
        Schema::dropIfExists('profile_matching_detail_scores');
    }
}
