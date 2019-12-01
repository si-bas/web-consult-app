<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use SoftDeletes;

    protected $table = 'genders';
    protected $fillable = [
        "code",
        "name"
    ];
}
