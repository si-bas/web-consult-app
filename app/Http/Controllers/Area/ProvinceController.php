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

        return DataTables::of($provinces)
        ->addColumn('action', function($province) {
            return '<a href="#"><i class="badge-circle badge-circle-light-secondary bx bx-pencil font-medium-1"></i></a>';
        })
        ->rawColumns([
            'action'
        ])
        ->make(true);
    }

    public function create(Request $request)
    {
        if (Province::where('code', $request->code)->count()) {
            $error = 'Error! Kode provinsi telah digunakan';
        } else {
            try {
                Province::create($request->all());
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat menyimpan data provinsi';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data provinsi!' : $error
        ];
    }

    public function getData(Request $request)
    {
        # code...
    }

    public function update(Request $request)
    {
        # code...
    }
}
