<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_questionnaire extends Model
{
    use SoftDeletes;

    protected $table = 'student_questionnaire';
    protected $fillable = [
        "student_id",
        "questionnaire_id",
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }

    public function questionnaire()
    {
        return $this->belongsTo('App\Models\Questionnaire\Questionnaire', 'questionnaire_id', 'id');
    }
    
    public function student_answers()
    {
        return $this->hasMany('App\Models\Questionnaire\Student_answer', 'student_questionnaire_id', 'id');
    }
}
