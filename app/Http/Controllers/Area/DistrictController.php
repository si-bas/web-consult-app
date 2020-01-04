<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\Area\District;
use App\Models\Area\Province;

class DistrictController extends Controller
{
    public function list()
    {
        return view('contents.area.district.list');
    }

    public function data(Request $request)
    {
        $districts = District::select(DB::raw('districts.*'))->has('province')->with([
            'province'
        ])->withCount([
            'subdistricts'
        ]);

        return DataTables::of($districts)
        ->addColumn('action', function($district) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$district->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$district->id.', \''.$district->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
                </div>
            </div>';
        })
        ->rawColumns([
            'action'
        ])
        ->make(true);
    }

    public function getProvinces(Request $request)
    {
        $query = Province::orderBy('name');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }

    public function create(Request $request)
    {
        if (District::where('code', $request->code)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                District::create($request->all());
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat menyimpan data kabupaten';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data kabupaten' : $error
        ];
    }

    public function getData(Request $request)
    {
        return District::find($request->id)->load('province');
    }

    public function update(Request $request)
    {
        if (District::where('code', $request->code)->where('id', '!=', $request->id)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                $district = District::find($request->id);
                $district->fill($request->all());
                $district->save();
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat mengubah data kabupaten';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data kabupaten' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            District::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terdapat kesalahan saat menghapus provinsi';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data provinsi!' : $error
        ];
    }
}
