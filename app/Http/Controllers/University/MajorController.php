<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\University\Major;

class MajorController extends Controller
{
    public function list()
    {
        # code...
    }

    public function data(Request $request)
    {
        $majors = Major::select(DB::select('majors'))->with([
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
}
