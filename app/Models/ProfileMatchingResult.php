<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatchingResult extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pegawai_id', 
        'total_score', 
        'cf_score', 
        'sf_score', 
        'detail_results'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}