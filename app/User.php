<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laratrust\Traits\LaratrustUserTrait;
use Shetabit\Visitor\Traits\Visitor;
use Illuminate\Support\Facades\Hash;
use Yadahan\AuthenticationLog\AuthenticationLogable;

# Jobs
use App\Jobs\Email\RegistrationVerified;
use App\Jobs\Email\RegistrationStudent;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use Visitor;
    use AuthenticationLogable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password', 'password_hint', 'verified_at', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'password_hint', 'code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at' => 'datetime'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPasswordHintAttribute($value)
    {
        $this->attributes['password_hint'] = Crypt::encrypt($value);;
    }

    public function setVerifiedAtAttribute($value)
    {
        if (config('custom.student_verification') ?? true) {
            dispatch(new RegistrationVerified($this->id));
        } else {
            dispatch(new RegistrationStudent($this->id));
        }
        
        $this->attributes['verified_at'] = $value;
    }

    public function student()
    {
        return $this->hasOne('App\Models\Profile\Student', 'user_id', 'id');
    }

    public function lecturer()
    {
        return $this->hasOne('App\Models\Profile\Lecturer', 'user_id', 'id');
    }
}
