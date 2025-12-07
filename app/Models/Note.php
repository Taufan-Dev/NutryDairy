<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'food_menu',
        'food_consumed',
        'items',
        'photo'
    ];

    protected $casts = [
        'items' => 'array'
    ];
}
