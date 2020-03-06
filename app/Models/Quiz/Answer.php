<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $table = 'quiz_answers';
    protected $fillable = [                
        "quiz_question_id",
        "image",
        "text",
        "poin",
        "type",        
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Quiz\Question', 'quiz_question_id', 'id');
    }
}
