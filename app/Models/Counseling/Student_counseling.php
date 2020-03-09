<?php

namespace App\Models\Counseling;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_counseling extends Model
{
    use SoftDeletes;

    protected $table = 'student_counselings';
    protected $fillable = [
        "student_id",        
        "counseling_question_id",
        "answer",
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Counseling\Question', 'counseling_question_id', 'id');
    }
}
