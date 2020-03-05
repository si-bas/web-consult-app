<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaire_results';
    protected $fillable = [
        "questionnaire_id",
        "score_from",
        "score_to",
        "information",
    ];

    public function questionnaire()
    {
        return $this->belongsTo('App\Models\Questionnaire\Questionnaire', 'questionnaire_id', 'id');
    }
}
