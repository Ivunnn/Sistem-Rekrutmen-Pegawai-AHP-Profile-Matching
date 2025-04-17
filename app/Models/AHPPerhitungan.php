<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AHPPerhitungan extends Model
{
    use HasFactory;

    protected $table = 'ahp_perhitungans'; // ← Tambahkan ini

    protected $primaryKey = 'id_perhitungan';

    protected $fillable = [
        'nama_perhitungan',
        'detail',
        'user_id',
        'is_konsisten',
        'lambda_max',
        'consistency_index',
        'consistency_ratio',
        'is_created_by_admin',
    ];

    public function bobots()
    {
        return $this->hasMany(BobotKriteria::class, 'id_perhitungan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
