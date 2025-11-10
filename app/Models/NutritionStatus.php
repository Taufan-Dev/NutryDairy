<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionStatus extends Model
{
    protected $table = 'nutrition_status';
    protected $fillable = [
        'measurement_id',
        'bb_u_status',
        'bb_tb_status',
        'tb_u_status',
    ];

    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement_id');
    }
}
