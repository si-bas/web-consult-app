<?php

namespace App\Models\Schedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use SoftDeletes;

    protected $table = 'lecturer_schedules';
    protected $fillable = [
        "lecturer_id",
        "day_id",
        "start_time",
        "end_time",
    ];

    public function day()
    {
        return $this->belongsTo('App\Models\Schedule\Day', 'day_id', 'id');
    }

    public function lecturer()
    {
        return $this->belongsTo('App\Models\Profile\Lecturer', 'lecturer_id', 'id');
    }
}
