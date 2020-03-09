<?php

namespace App\Models\Evaluation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_evaluation extends Model
{
    use SoftDeletes;

    protected $table = 'student_evaluations';
    protected $fillable = [
        "student_id",
        "feeling_before",
        "ability_before",
        "feeling_after",
        "ability_after",
        "is_satisfy",
        "suggestions",
        "satisfaction"
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }
}
