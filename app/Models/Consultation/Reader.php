<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Model
{
    use SoftDeletes;

    protected $table = 'consult_message_readers';
    protected $fillable = [
        "message_id",
        "user_id",
        "read_at"
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo('App\Models\Consultation\Message', 'message_id', 'id');
    }
}
