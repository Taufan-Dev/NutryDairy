<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';
    protected $fillable = [
        'user_id',
        'education_content_id',
        'type',
        'score',
    ];
}
