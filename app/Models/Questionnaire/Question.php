<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaire_questions';
    protected $fillable = [
        "questionnaire_id",
        "order",
        "text",
        "image",
        "answer_text",
    ];

    public function questionnaire()
    {
        return $this->belongsTo('App\Models\Questionnaire\Questionnaire', 'questionnaire_id', 'id');
    }
}
