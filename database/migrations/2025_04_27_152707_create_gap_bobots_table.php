<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapBobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_bobots', function (Blueprint $table) {
            $table->id();
            $table->integer('selisih');
            $table->float('bobot');
            $table->string('keterangan');
            $table->timestamps();
        });

        // Tambahkan data default
        $this->seedGapBobot();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gap_bobots');
    }

    /**
     * Seed default gap bobot values.
     */
    private function seedGapBobot()
    {
        $gaps = [
            ['selisih' => 0, 'bobot' => 5.0, 'keterangan' => 'Tidak ada selisih (kompetensi sesuai dengan yang dibutuhkan)'],
            ['selisih' => 1, 'bobot' => 4.5, 'keterangan' => 'Kompetensi individu kelebihan 1 tingkat'],
            ['selisih' => -1, 'bobot' => 4.0, 'keterangan' => 'Kompetensi individu kekurangan 1 tingkat'],
            ['selisih' => 2, 'bobot' => 3.5, 'keterangan' => 'Kompetensi individu kelebihan 2 tingkat'],
            ['selisih' => -2, 'bobot' => 3.0, 'keterangan' => 'Kompetensi individu kekurangan 2 tingkat'],
            ['selisih' => 3, 'bobot' => 2.5, 'keterangan' => 'Kompetensi individu kelebihan 3 tingkat'],
            ['selisih' => -3, 'bobot' => 2.0, 'keterangan' => 'Kompetensi individu kekurangan 3 tingkat'],
            ['selisih' => 4, 'bobot' => 1.5, 'keterangan' => 'Kompetensi individu kelebihan 4 tingkat'],
            ['selisih' => -4, 'bobot' => 1.0, 'keterangan' => 'Kompetensi individu kekurangan 4 tingkat'],
        ];

        DB::table('gap_bobots')->insert($gaps);
    }
}