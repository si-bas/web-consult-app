<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'content_students';
    protected $fillable = [
        "student_id",
        "content_id",
        "content_type",
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }
}
