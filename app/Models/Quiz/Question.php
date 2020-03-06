<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'quiz_questions';
    protected $fillable = [                
        "quiz_id",
        "order",
        "html",
        "image",
        "type",        
    ];
    
    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz\Quiz', 'quiz_id', 'id');
    }
}
