<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_peserta',
        'name',
        'tanggal',
        'jabatan',
        'bagian',
        'bagian_dilamar',
        'pendidikan',
        'pengalaman_kerja',
        'wawancara',
        'sertifikasi_pendukung',
        'kemampuan',
        'cv'
    ];
    
}
