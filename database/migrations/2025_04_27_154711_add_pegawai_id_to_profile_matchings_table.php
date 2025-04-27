<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPegawaiIdToProfileMatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_matchings', function (Blueprint $table) {
            $table->unsignedBigInteger('pegawai_id')->nullable();
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
            $table->dropColumn('pegawai_id');
        });
    }
}
