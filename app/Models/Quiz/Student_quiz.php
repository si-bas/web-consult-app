<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_quiz extends Model
{
    use SoftDeletes;

    protected $table = 'student_quizzes';
    protected $fillable = [
        "quiz_id",
        "student_id",
        "result_html",
        "result_json"
    ];

    protected $casts = [
        'result_json' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz\Quiz', 'quiz_id', 'id');
    }
}
