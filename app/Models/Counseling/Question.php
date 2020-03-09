<?php

namespace App\Models\Counseling;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'counseling_questions';
    protected $fillable = [        
        "order",
        "text",
        "image",
    ];
}
