<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;

    protected $table = 'universities';
    protected $fillable = [
        "name",
        "status",
    ];

    public function faculties()
    {
        return $this->hasMany('App\Models\University\Faculty', 'university_id', 'id');
    }
}
