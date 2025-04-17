<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AHPCalculation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ahp_calculations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama',
        'detail',
        'consistency_ratio',
        'matrix_data',
    ];

    /**
     * Get the user that owns the AHP calculation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}