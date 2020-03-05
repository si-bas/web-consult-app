<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_video extends Model
{
    use SoftDeletes;

    protected $table = 'student_videos';
    protected $fillable = [
        "student_id",
        "content_video_id",
        "updated_at"
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }
}
