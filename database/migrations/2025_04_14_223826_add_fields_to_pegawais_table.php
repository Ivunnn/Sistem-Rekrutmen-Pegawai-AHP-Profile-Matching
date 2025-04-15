<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('bagian_dilamar')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('wawancara')->nullable();
            $table->text('sertifikasi_pendukung')->nullable();
            $table->text('kemampuan')->nullable();
            $table->string('cv')->nullable(); // untuk file upload
        });
    }
    
    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn([
                'bagian_dilamar',
                'pendidikan',
                'pengalaman_kerja',
                'wawancara',
                'sertifikasi_pendukung',
                'kemampuan',
                'cv',
            ]);
        });
    }
    
}
