<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaire_answers';
    protected $fillable = [
        "questionnaire_question_id",
        "text",
        "image",
        "poin",
        "type",
    ];
}
