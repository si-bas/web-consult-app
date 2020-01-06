<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\University\Major;
use App\Models\University\Faculty;

class MajorController extends Controller
{
    public function list()
    {
        return view('contents.university.major.list');
    }

    public function data(Request $request)
    {
        $majors = Major::select(DB::raw('majors.*'))->with([
            'faculty'
        ])->withCount([
            'students'
        ]);

        return DataTables::of($majors)
        ->addColumn('action', function($major) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$major->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$major->id.', \''.$major->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
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
        if (Major::where('code', $request->code)->where('faculty_id', $request->faculty_id)->count()) {
            $error = 'Error! Kode sudah digunakan pada fakultas yang sama';
        } else {
            try {
                Major::create($request->all());
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat menyimpan jurusan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data jurusan' : $error
        ];
    }

    public function getFaculties(Request $request)
    {
        $query = Faculty::orderBy('name');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }

    public function getData(Request $request)
    {
        return Major::find($request->id)->load('faculty');
    }

    public function update(Request $request)
    {
        if (Major::where('code', $request->code)->where('faculty_id', $request->faculty_id)->where('id', '!=', $request->id)->count()) {
            $error = 'Error! Kode sudah digunakan pada fakultas yang sama';
        } else {
            try {
                $major = Major::find($request->id);
                $major->fill($request->all());
                $major->save();
            } catch (\Exception $e) {
                $error = 'Error! Terjadi kesalahan saat mengubah data jurusan';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data jurusan' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            Major::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat menghapus data jurusan';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data jurusan' : $error
        ];
    }
}
