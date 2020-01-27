<?php

namespace App\Models\Schedule;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    protected $fillable = [
        "code",
        "name",
        "day_number",
    ];
}
