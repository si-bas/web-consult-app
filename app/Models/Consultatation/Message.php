<?php

namespace App\Models\Consultatation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'consult_messages';
    protected $fillable = [
        "consult_id",
        "user_id",
        "message",
        "created_at"
    ];

    public function consult()
    {
        return $this->belongsTo('App\Models\Consultatation\Consult', 'consult_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getTimestampAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y @ H:i');
    }
}
