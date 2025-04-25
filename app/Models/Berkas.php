<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'bagian',
        'pendidikan',
        'sertifikat_pendukung',
        'cv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
