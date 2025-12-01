<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EducationContent extends Model
{
    protected $table = 'education_contents';
    protected $fillable = [
        'title',
        'slug',
        'type',
        'media_type',
        'category',
        'content',
        'media_url',
        'thumbnail',
        'published_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($educationContent) {
            $educationContent->slug = Str::slug($educationContent->title);
        });

        static::updating(function ($educationContent) {
            $educationContent->slug = Str::slug($educationContent->title);
        });
    }
}
