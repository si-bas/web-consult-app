<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_answer extends Model
{
    use SoftDeletes;

    protected $table = 'student_questionnaire_answer';
    protected $fillable = [
        "student_questionnaire_id",
        "questionnaire_question_id",
        "answer",
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Questionnaire\Question', 'questionnaire_question_id', 'id');
    }

    public function student_questionnaire()
    {
        return $this->belongsTo('App\Model\Questionnaire\Student_questionnaire', 'student_questionnaire_id', 'id');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Questionnaire\answer', 'answer', 'id');
    }
}
