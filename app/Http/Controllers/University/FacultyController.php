<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\University\Faculty;

class FacultyController extends Controller
{
    public function list()
    {
        return view('contents.university.faculty.list');
    }

    public function data(Request $request)
    {
        $faculties = Faculty::select(DB::raw('faculties.*'))->withCount([
            'majors'
        ]);

        return DataTables::of($faculties)
        ->addColumn('action', function($faculty) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$faculty->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                    <a class="dropdown-item" href="javascript:;" onclick="deleteRow('.$faculty->id.', \''.$faculty->name.'\')"><i class="bx bx-trash mr-1"></i> hapus</a>
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
        try {
            Faculty::create($request->all());
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat minyimpan data fakultas';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menyimpan data fakultas' : $error
        ];
    }

    public function getData(Request $request)
    {
        return Faculty::find($request->id);
    }
    
    public function update(Request $request)
    {
        try {
            $faculty = Faculty::find($request->id);
            $faculty->fill($request->all());
            $faculty->save();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat mengubah data fakultas';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah data fakultas' : $error
        ];
    }

    public function delete(Request $request)
    {
        try {
            Faculty::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat menghapus data fakultas';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data fakultas' : $error
        ];
    }
}
