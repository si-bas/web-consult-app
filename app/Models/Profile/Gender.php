<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';
    protected $fillable = [
        "code",
        "name"
    ];
}
