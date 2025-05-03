<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiIdeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'nilai_ideal',
        'tipe_faktor',
        'nilai', // Add this line
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}