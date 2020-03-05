<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'content_videos';
    protected $fillable = [
        "code",
        "title",
        "path",
        "filename",
        "is_required",
    ];

    public function getTable()
    {
        return $this->table;
    }
    
    public function viewers()
    {
        return $this->hasMany('App\Models\Content\Student_video', 'content_video_id', 'id');
    }
}
