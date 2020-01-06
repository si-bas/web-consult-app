<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use SoftDeletes;

    protected $table = 'majors';
    protected $fillable = [
        "faculty_id",
        "code",
        "name",
    ];

    public function faculty()
    {
        return $this->belongsTo('App\Models\University\Faculty', 'faculty_id', 'id');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Profile\Student', 'major_id', 'id');
    }
}
