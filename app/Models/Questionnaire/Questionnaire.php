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
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Questionnaire\Question', 'questionnaire_id', 'id');
    }
}
