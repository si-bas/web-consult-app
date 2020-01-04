<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laratrust\Traits\LaratrustUserTrait;
use Shetabit\Visitor\Traits\Visitor;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use Visitor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password', 'password_hint'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPasswordHintAttribute($value)
    {
        $this->attributes['password_hint'] = Crypt::encrypt($value);;
    }
}
