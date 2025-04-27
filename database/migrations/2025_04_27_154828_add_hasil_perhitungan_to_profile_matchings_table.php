<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasilPerhitunganToProfileMatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_matchings', function (Blueprint $table) {
            // $table->unsignedBigInteger('pegawai_id')->nullable(); // <-- INI DIHAPUS
            $table->longText('hasil_perhitungan')->nullable();
            $table->decimal('nilai_cf', 8, 4)->nullable();
            $table->decimal('nilai_sf', 8, 4)->nullable();
            $table->decimal('nilai_total', 8, 4)->nullable();
            $table->decimal('nilai_akhir', 8, 4)->nullable();
            $table->integer('ranking')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_matchings', function (Blueprint $table) {
            $table->dropColumn('hasil_perhitungan');
        });
    }
}
