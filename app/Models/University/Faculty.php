<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $table = 'faculties';
    protected $fillable = [
        "university_id",
        "code",
        "name",
    ];

    public function university()
    {
        return $this->belongsTo('App\Models\University\University', 'university_id', 'id');
    }

    public function majors()
    {
        return $this->hasMany('App\Models\University\Major', 'faculty_id', 'id');
    }
}
