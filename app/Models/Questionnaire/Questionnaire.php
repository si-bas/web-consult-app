<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaires';
    protected $fillable = [
        "user_id",
        "code",
        "name",
        "is_required",
        "is_active",
        "guide_text"
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Questionnaire\Question', 'questionnaire_id', 'id');
    }

    public function getQuestionTypesAttribute()
    {
        return ['free_text' => 'Teks Bebas', 'single_select' => 'Satu Pilihan', 'multiple_select' => 'Pilihan Ganda'];
    }

    public function student_questionnaire()
    {
        return $this->hasMany('App\Models\Questionnaire\Student_questionnaire', 'questionnaire_id', 'id');
    }
}
