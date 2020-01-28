<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

# Models
use App\Models\Profile\Gender;

class Student_profile extends Model
{
    use SoftDeletes;

    protected $table = 'student_profiles';
    protected $fillable = [
        "student_id",
        "age",
        "gender_id",
        "religion",
        "semester",
        "major_id",
        "classroom",
        "has_history_violence",
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Profile\Gender', 'gender_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\University\Major', 'major_id', 'id');
    }

    public function solving_options()
    {
        return $this->belongsToMany('App\Models\Questionnaire\Problem_solving_option', 'problem_solving_student', 'student_profile_id', 'problem_solving_option_id');
    }

    public function setGenderIdAttribute($value)
    {
        $gender = Gender::where('code', $value)->first() ?? Gender::first();

        $this->attributes['gender_id'] = $gender->id;
    }
}
