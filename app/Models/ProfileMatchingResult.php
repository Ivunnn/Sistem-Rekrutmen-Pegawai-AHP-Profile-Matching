<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatchingResult extends Model
{
    protected $fillable = ['pegawai_id', 'total_score'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
