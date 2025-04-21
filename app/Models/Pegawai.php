<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tanggal',
        'jabatan',
        'bagian',
        'bagian_dilamar',
        'pendidikan',
        'pengalaman_kerja',
        'sertifikasi_pendukung',
        'kemampuan',
        'cv'
    ];
    
}