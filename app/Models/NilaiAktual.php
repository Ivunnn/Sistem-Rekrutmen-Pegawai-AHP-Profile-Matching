<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAktual extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'kriteria_id', 'nilai'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
