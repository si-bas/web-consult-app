<?php

namespace App\Models\Area;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $table = 'provinces';
    protected $fillable = [
        'code', 'name'
    ];

    public function districts()
    {
        return $this->hasMany('App\Models\Area\District', 'province_id', 'id');
    }
}
