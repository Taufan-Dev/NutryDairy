<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $table = 'measurements';
    protected $fillable = [
        'child_id',
        'measured_at',
        'weight_kg',
        'height_cm',
        'muac_cm',
    ];

    protected $dates = [
        'measured_at',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class, 'child_id');
    }

    public function nutritionStatus()
    {
        return $this->hasOne(NutritionStatus::class, 'measurement_id');
    }
}
