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
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$province->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$province->id.', \''.$province->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
                </div>
            </div>';
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
        return Province::find($request->id);
    }

    public function update(Request $request)
    {
        if (Province::where('code', $request->code)->where('id', '!=', $request->id)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                $province = Province::find($request->id);
                $province->fill($request->all());
                $province->save();
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat mengubah data provinsi';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data provinsi!' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            Province::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terdapat kesalahan saat menghapus provinsi';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data provinsi!' : $error
        ];
    }
}
