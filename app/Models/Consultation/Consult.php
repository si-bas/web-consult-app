<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consult extends Model
{
    use SoftDeletes;

    protected $table = 'consults';
    protected $fillable = [
        "lecturer_id",
        "student_id",
        "lecturer_schedule_id",
        "reason",
        "is_meeting",
        "is_done",
        "updated_at"
    ];

    public function lecturer()
    {
        return $this->belongsTo('App\Models\Profile\Lecturer', 'lecturer_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Profile\Student', 'student_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule\Lecturer', 'lecturer_schedule_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Consultation\Message', 'consult_id', 'id');
    }
}
