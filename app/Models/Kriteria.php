<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Tambahkan field yang boleh di-mass assign
    protected $fillable = [
        'nama',
        'bobot',
    ];
}
