<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\User;

class StudentController extends Controller
{
    public function list()
    {
        return view('contents.user.student.list');
    }

    public function data(Request $request)
    {
        $users = User::select(DB::raw('users.*'))->has('student')->with([
            'student.major.faculty'
        ]);

        if (!empty($request->is_verified)) {
            $users->whereNotNull('verified_at');
        } else {
            $users->whereNull('verified_at');
        }

        return DataTables::of($users)
        ->addColumn('action_verify', function($user) {
            $verification = empty($user->verified_at) ? '<a class="dropdown-item" href="javascript:;" onclick="verifyUser('.$user->id.')"><i class="bx bx-check mr-1"></i> verifikasi</a>
            <hr>
            <a class="dropdown-item" href="javascript:;"><i class="bx bx-archive mr-1"></i> arsipkan</a>' : '';

            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showDetail('.$user->id.')"><i class="bx bxs-user-detail mr-1"></i> rincian</a>
                    '.$verification.'
                </div>
            </div>';
        })
        ->rawColumns([
            'action_verify'
        ])
        ->make(true);
    }

    public function verify(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->verified_at = Carbon::now()->toDateTimeString();
            $user->save();
        } catch (\Exception $e) {
            $error = "Error! Terjadi kesalahan saat memverifikasi mahasiswa";
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil memverifikasi mahasiswa' : $error
        ];
    }

    public function detail(Request $request)
    {
        $user = User::find($request->id)->load([
            'student.major.faculty'
        ]);

        return view('contents.user.student.detail', [
            'user' => $user
        ]);
    }
}
