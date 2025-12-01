<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = [
        'education_content_id',
        'question',
        'options',
        'answer',
        'type',
    ];
    protected $casts = [
        'options' => 'array',
    ];

    public function educationContent()
    {
        return $this->belongsTo(EducationContent::class);
    }
}
