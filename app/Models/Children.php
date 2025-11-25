<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';
    protected $fillable = [
        'parent_id',
        'name',
        'birth_date',
        'gender',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'child_id');
    }

    public function feedingHabits()
    {
        return $this->hasMany(FeedingHabit::class, 'child_id');
    }

    public function getAgeInDays($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();
        return $this->birth_date->diffInDays($date);
    }
}
