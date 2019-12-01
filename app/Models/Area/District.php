<?php

namespace App\Models\Area;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $table = 'districts';
    protected $fillable = [
        'province_id', 'code', 'name'
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Area\Province', 'province_id', 'id');
    }

    public function subdistricts()
    {
        return $this->hasMany('App\Models\Area\Subdistrict', 'district_id', 'id');
    }
}
