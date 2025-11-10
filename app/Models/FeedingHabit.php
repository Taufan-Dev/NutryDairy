<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedingHabit extends Model
{
    protected $table = 'feeding_habits';
    protected $fillable = [
        'child_id',
        'filled_at',
        'meals_per_day',
        'veg_fruit_freq',
        'milk_freq',
        'snack_freq',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class, 'child_id');
    }
}
