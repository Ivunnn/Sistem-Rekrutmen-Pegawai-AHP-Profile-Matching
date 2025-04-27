<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GapBobot extends Model
{
    use HasFactory;

    protected $fillable = [
        'selisih',
        'bobot',
        'keterangan',
    ];
}