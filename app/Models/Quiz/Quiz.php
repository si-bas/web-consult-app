<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;
    
    protected $table = 'quizzes';
    protected $fillable = [
        "code",
        "name",
        "description",
        "is_required",        
        "is_active",
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Quiz\Question', 'quiz_id', 'id');
    }
    
    public function student_quiz()
    {
        return $this->hasMany('App\Models\Quiz\Student_quiz', 'quiz_id', 'id');
    }
}
