<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    protected $table = 'ahp_detail_bobot_kriteria';

    protected $fillable = [
        'id_perhitungan',
        'kriteria_id',
        'bobot',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(AHPPerhitungan::class, 'id_perhitungan');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
