<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

# Models
use App\Models\Profile\Gender;

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
        "major_id"
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Profile\Gender', 'gender_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\University\Major', 'major_id', 'id');
    }

    public function setGenderIdAttribute($value)
    {
        $gender = Gender::where('code', $value)->first() ?? Gender::first();

        $this->attributes['gender_id'] = $gender->id;
    }

    public function setDateOfBirthAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }
    }

    public function getDateOfBirthAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::parse($this->attributes['date_of_birth'])->formatLocalized("%d %B %Y");
        }

        return '';
    }

    public function getDateOfBirthFormatAttribute()
    {
        if (!empty($this->getOriginal('date_of_birth'))) {
            return Carbon::parse($this->getOriginal('date_of_birth'))->format("d/m/Y");
        }

        return '';
    }
}
