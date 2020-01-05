<?php

namespace App\Models\Area;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use SoftDeletes;

    protected $table = 'villages';
    protected $fillable = [
        'subdistrict_id', 'code', 'name'
    ];

    public function subdistrict()
    {
        return $this->belongsTo('App\Models\Area\Subdistrict', 'subdistrict_id', 'id');
    }
}
