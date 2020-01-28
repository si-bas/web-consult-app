<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem_solving_option extends Model
{
    use SoftDeletes;
    protected $table = 'problem_solving_options';
    protected $fillable = [
        "name"
    ];
}
