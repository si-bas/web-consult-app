<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\Area\Province;

class ProvinceController extends Controller
{
    public function list()
    {
        return view('contents.area.province.list');
    }

    public function data()
    {
        $provinces = Province::select(DB::raw('provinces.*'))
        ->withCount([
            'districts',
            'districts AS subdistricts_count' => function($query) {
                $query->join('subdistricts', 'subdistricts.district_id', '=', 'districts.id');
            },
            'districts AS villages_count' => function($query) {
                $query->join('subdistricts', 'subdistricts.district_id', '=', 'districts.id')
                ->join('villages', 'villages.subdistrict_id', '=', 'subdistricts.id');
            },
        ]);

        return DataTables::of($provinces)->make(true);
    }
}
