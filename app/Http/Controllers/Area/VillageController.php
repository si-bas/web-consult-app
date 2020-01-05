<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\Area\Village;
use App\Models\Area\Subdistrict;

class VillageController extends Controller
{
    public function list()
    {
        return view('contents.area.village.list');
    }

    public function data(Request $request)
    {
        $villages = Village::select(DB::raw('villages.*'))->has('subdistrict.district.province')->with([
            'subdistrict.district'
        ]);

        return DataTables::of($villages)
        ->addColumn('action', function($village) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$village->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$village->id.', \''.$village->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
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
        if (Village::where('code', $request->code)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                Village::create($request->all());
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat menyimpan data kelurahan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data kelurahan' : $error
        ];
    }

    public function getSubdistricts(Request $request)
    {
        $query = Subdistrict::orderBy('name')->has('district.province');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }

    public function getData(Request $request)
    {
        return Village::find($request->id)->load('subdistrict');
    }

    public function update(Request $request)
    {
        if (Village::where('code', $request->code)->where('id', '!=', $request->id)->count()) {
            $error = 'Error! Kode telah digunakan';
        } else {
            try {
                $village = Village::find($request->id);
                $village->fill($request->all());
                $village->save();
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat mengubah data kelurahan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data kelurahan' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            Village::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terdapat kesalahan saat menghapus provinsi';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data provinsi!' : $error
        ];
    }
}
