<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class Student_activity extends Model
{
    protected $table = 'student_activity';
    protected $fillable = [
        "id",
        "first_name",
        "last_name",
        "student_id_number",
        "need_consult",
        "count_pre",
        "is_done",
        "count_post",
    ];

    public function evaluation()
    {
        return $this->hasOne('App\Models\Evaluation\Student_evaluation', 'student_id', 'id')->latest();
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'id', 'id');
    }
}
