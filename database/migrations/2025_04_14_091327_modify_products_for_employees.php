<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsForEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom baru
            $table->string('no_peserta')->after('id');
            $table->date('tanggal')->nullable()->after('name');
            $table->string('jabatan')->after('tanggal');
            $table->string('bagian')->after('jabatan');
        });

        // Drop kolom yang tidak dibutuhkan di luar dari closure agar tidak error jika menggunakan SQLite atau engine tertentu
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'harga', 'prosesor', 'kapasitas_ram', 'kapasitas_hdd',
                'kapasitas_ssd', 'kapasitas_vram', 'kapasitas_maxram',
                'berat', 'ukuran_layar', 'jenis_layar', 'refresh_rate', 'resolusi_layar'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Balikin kolom yang dihapus (optional)
            $table->double('harga')->nullable();
            $table->double('prosesor')->nullable();
            $table->double('kapasitas_ram')->nullable();
            $table->double('kapasitas_hdd')->nullable();
            $table->double('kapasitas_ssd')->nullable();
            $table->double('kapasitas_vram')->nullable();
            $table->double('kapasitas_maxram')->nullable();
            $table->double('berat')->nullable();
            $table->double('ukuran_layar')->nullable();
            $table->unsignedSmallInteger('jenis_layar')->nullable();
            $table->unsignedSmallInteger('refresh_rate')->nullable();
            $table->unsignedInteger('resolusi_layar')->nullable();

            // Drop kolom baru
            $table->dropColumn(['no_peserta', 'tanggal', 'jabatan', 'bagian']);
        });
    }
}
