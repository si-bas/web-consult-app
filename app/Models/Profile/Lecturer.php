<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use SoftDeletes;

    protected $tbale = 'lecturers';
    protected $fillable = [
        "nip",
        "full_name",
        "place_of_birth",
        "date_of_birth",
        "gender_id",
        "address",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Profile', 'gender_id', 'id');
    }
}
