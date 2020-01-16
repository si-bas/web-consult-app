<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\User;

class LecturerController extends Controller
{
    public function list()
    {
        return view('contents.user.lecturer.list');
    }

    public function data(Request $request)
    {
        $users = User::select(DB::raw('users.*'))->has('lecture')->with([
            'lecture.gender'
        ]);

        return DataTables::of($users)
        ->addColumn('action', function($user) {
            return '';
        })
        ->make(true);
    }

    public function formCreate()
    {
        return view('contents.user.lecturer.form-create');
    }
}
