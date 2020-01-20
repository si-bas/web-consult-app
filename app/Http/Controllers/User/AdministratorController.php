<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

# Models
use App\User;

class AdministratorController extends Controller
{
    public function list()
    {
        return view('contents.user.administrator.list');
    }

    public function data(Request $request)
    {
        $users = User::select(DB::raw('users.*'))->whereHas('roles', function($query) {
            $query->where('name', 'admin');
        });

        return DataTables::of($users)
        ->editColumn('created_at', function($user) {
            return Carbon::parse($user->created_at)->formatLocalized("%d %B %Y");
        })
        ->editColumn('verified_at', function($user) {
            return empty($user->verified_at) ? '<span class="text-danger">Nonaktif</span>' : '<span class="text-success">Aktif</span>';
        })
        ->addColumn('action', function($user) {
            $switch_status = empty($user->verified_at) ? '<i class="bx bxs-user-check mr-1"></i> aktifkan' : '<i class="bx bxs-user-x mr-1"></i> nonaktifkan';

            return '<div class="dropdown">
            <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
            </span>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="javascript:;" onclick="showFormUpdate('.$user->id.')"><i class="bx bx-edit-alt mr-1"></i> ubah</a>
                <a class="dropdown-item" href="javascript:;" onclick="deactiveRow('.$user->id.', \''.$user->name.'\', \''.(empty($user->verified_at) ? 'mengaktifkan' : 'menonaktifkan').'\')">'.$switch_status.'</a>
            </div>
        </div>';
        })
        ->rawColumns([
            'action', 'verified_at'
        ])
        ->make(true);
    }

    public function getData(Request $request)
    {
        return User::find($request->id);
    }

    public function create(Request $request)
    {
        try {
            $user = new User($request->all());
            $user->password_hint = $request->password;
            $user->verified_at = Carbon::now()->toDateTimeString();
            $user->save();

            $user->attachRole('admin');
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('user.administrator.list')->with(empty($error) ? 'success' : 'error', empty($error) ? 'Berhasil menyimpan data Administrator!' : 'Terjadi kesalahan saat menyimpan data Administrator!');
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->id);
            $password = $user->password;
            $user->fill($request->all());

            if (empty($request->password)) {
                $user->password = $password;
            } else {
                $user->password_hint = $request->password;
            }

            $user->save();
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('user.administrator.list')->with(empty($error) ? 'success' : 'error', empty($error) ? 'Berhasil menyimpan perubahan Administrator!' : 'Terjadi kesalahan saat menyimpan perubahan Administrator!');
    }

    public function checkEmail(Request $request)
    {
        if ($request->exists('email')) {
            $user = User::where('email', $request->email);

            if (!empty($request->id)) {
                $user->where('id', '!=', $request->id);
            }

            return $user->count();
        }

        return 1;
    }

    public function switchStatus(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->verified_at = empty($user->verified_at) ? Carbon::now()->toDateTimeString() : null;
            $user->save();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat mengubah status';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mengubah status Administrator' : $error
        ];
    }
}
