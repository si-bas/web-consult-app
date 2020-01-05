<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\Area\Subdistrict;
use App\Models\Area\District;

class SubdistrictController extends Controller
{
    public function list()
    {
        return view('contents.area.subdistrict.list');
    }

    public function data()
    {
        $subdistricts = Subdistrict::select(DB::raw('subdistricts.*'))->has('district.province')->with([
            'district'
        ])->withCount([
            'villages'
        ]);

        return DataTables::of($subdistricts)
        ->addColumn('action', function($subdistrict) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$subdistrict->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$subdistrict->id.', \''.$subdistrict->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
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
        if (Subdistrict::where('code', $request->code)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                Subdistrict::create($request->all());
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat menyimpan data kecamatan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data kecamatan' : $error
        ];
    }

    public function getDistricts(Request $request)
    {
        $query = District::orderBy('name')->has('province');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }

    public function getData(Request $request)
    {
        return Subdistrict::find($request->id)->load('district');
    }

    public function update(Request $request)
    {
        if (Subdistrict::where('code', $request->code)->where('id', '!=', $request->id)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                $subdistrict = Subdistrict::find($request->id);
                $subdistrict->fill($request->all());
                $subdistrict->save();
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat mengubah data kecamatan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data kecamatan' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            Subdistrict::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terdapat kesalahan saat menghapus provinsi';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data kecamatan!' : $error
        ];
    }
}
