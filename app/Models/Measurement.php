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
        'zscore_bb_u',
        'zscore_tb_u',
        'zscore_bb_tb',
    ];

    protected $dates = [
        'measured_at',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class, 'child_id');
    }
}
