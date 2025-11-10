<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationContent extends Model
{
    protected $table = 'education_contents';
    protected $fillable = [
        'title',
        'slug',
        'type',
        'category',
        'content',
        'media_url',
        'published_at',
    ];
}
