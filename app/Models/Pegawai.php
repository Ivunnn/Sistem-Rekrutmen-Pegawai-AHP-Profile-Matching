<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id', // Add this
        'bagian_dilamar',
        'pendidikan',
        'pengalaman_kerja',
        'sertifikasi_pendukung',
        'kemampuan',
        'cv'
    ];

    public function nilaiAktual()
    {
        return $this->hasMany(NilaiAktual::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}