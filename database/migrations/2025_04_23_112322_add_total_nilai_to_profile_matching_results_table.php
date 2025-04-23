<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalNilaiToProfileMatchingResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_matching_results', function (Blueprint $table) {
            $table->decimal('total_nilai', 10, 4)->after('pegawai_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_matching_results', function (Blueprint $table) {
            $table->dropColumn('total_nilai');
        });
    }
}
