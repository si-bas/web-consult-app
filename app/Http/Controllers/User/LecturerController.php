<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

# Models
use App\User;
use App\Models\University\Faculty;
use App\Models\University\Major;
use App\Models\Profile\Lecturer;

# Jobs
use App\Jobs\Email\RegistrationLecturer;

class LecturerController extends Controller
{
    public function list()
    {
        return view('contents.user.lecturer.list');
    }

    public function data(Request $request)
    {
        $users = User::select(DB::raw('users.*'))->has('lecturer')->with([
            'lecturer.gender', 'lecturer.major.faculty'
        ]);

        return DataTables::of($users)
        ->addColumn('action', function($user) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showDetail('.$user->id.')"><i class="bx bxs-user-detail mr-1"></i> rincian</a>                    
                    <a class="dropdown-item" href="'.route('user.lecturer.form.update', ['id' => $user->id]).'"><i class="bx bxs-pencil mr-1"></i> ubah</a>
                    <hr>
                    <a class="dropdown-item" href="javascript:;" onclick="actionArchive('.$user->id.')"><i class="bx bx-archive mr-1"></i> arsipkan</a>
                </div>
            </div>';
        })
        ->make(true);
    }

    public function detail(Request $request)
    {
        $user = User::find($request->id)->load([
            'lecturer.major.faculty',
            'lecturer.gender'
        ]);

        return view('contents.user.lecturer.detail', [
            'user' => $user
        ]);
    }

    public function formCreate()
    {
        return view('contents.user.lecturer.form-create');
    }
    
    public function create(Request $request)
    {
        try {
            $user = new User($request->all());
            $user->name = $request->full_name;
            $user->password_hint = $request->password;
            $user->verified_at = Carbon::now()->toDateTimeString();
            $user->save();

            $lecturer = new Lecturer($request->all());
            $lecturer->user_id = $user->id;
            $lecturer->save();

            $lecturer->attachRole('lecturer');

            dispatch(new RegistrationLecturer($user->id));
        } catch (\Exception $e) {            
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('user.lecturer.list')->with(empty($error) ? 'success' : 'error', empty($error) ? 'Berhasil menyimpan data Dosen!' : 'Terjadi kesalahan saat menyimpan data Dosen!');
    }

    public function formUpdate(Request $request)
    {
        $user = User::where('id', $request->id)->has('lecturer')->first();

        if (empty($user)) return redirect()->route('user.lecturer.list')->with('error', 'Data dosen tidak ditemukan!');

        $user->load([
            'lecturer' => function($query) {
                $query->with([
                    'gender', 'major.faculty'
                ]);
            }
        ]);

        return view('contents.user.lecturer.form-update', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->id);
            $password = $user->password;
            $user->fill($request->all());
            $user->name = $request->full_name;

            if (empty($request->password)) {
                $user->password = $password;
            } else {
                $user->password_hint = $request->password;
            }

            $user->save();
            $user->lecturer->fill($request->all());
            $user->lecturer->save();
        } catch (\Exception $e) {            
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('user.lecturer.list')->with(empty($error) ? 'success' : 'error', empty($error) ? 'Berhasil menyimpan perubahan data Dosen!' : 'Terjadi kesalahan saat menyimpan perubahan data Dosen!');
    }

    public function getFaculties(Request $request)
    {
        $query = Faculty::orderBy('name');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }

    public function getMajors(Request $request)
    {
        $query = Major::orderBy('name')->has('faculty');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        if (!empty($request->faculty_id)) {
            $query->where('faculty_id', $request->faculty_id);
        }

        return $query->get(['id', 'name as text']);
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
}
