<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatching extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'hasil_perhitungan',
        'nilai_cf',
        'nilai_sf',
        'nilai_total',
        'nilai_akhir',
        'ranking',
    ];

    protected $casts = [
        'hasil_perhitungan' => 'array',
        'nilai_cf' => 'float',
        'nilai_sf' => 'float',
        'nilai_total' => 'float',
        'nilai_akhir' => 'float',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}