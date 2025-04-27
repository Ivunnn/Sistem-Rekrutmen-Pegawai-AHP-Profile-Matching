<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProfileMatchingResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_matching_results', function (Blueprint $table) {
            if (!Schema::hasColumn('profile_matching_results', 'cf_score')) {
                $table->decimal('cf_score', 8, 2)->default(0);
            }
            if (!Schema::hasColumn('profile_matching_results', 'sf_score')) {
                $table->decimal('sf_score', 8, 2)->default(0);
            }
            if (!Schema::hasColumn('profile_matching_results', 'detail_results')) {
                $table->text('detail_results')->nullable();
            }
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
            $table->dropColumn(['cf_score', 'sf_score', 'detail_results']);
        });
    }
}