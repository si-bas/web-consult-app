<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

# Models
use App\User;
use App\Models\Profile\Student;
use App\Models\University\Faculty;
use App\Models\University\Major;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function store(Request $request)
    {
        if (User::where('email', $request->email)->count()) {
            $error = 'Error! Email telah digunakan, silahkan gunakan email lain';
        } else {
            try {
                $user = User::create([
                    'name' => $request->first_name.' '.$request->last_name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'password_hint' => $request->password
                ]);
                $user->attachRole('student');
                
                $student = new Student($request->all());
                $student->user_id = $user->id;
                $student->save();

                if (!config('custom.student_verification') ?? false) {
                    $user->verified_at = Carbon::now()->toDateTimeString();
                    $user->save();
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                $error = 'Error! Terjadi kesalahan saat melakukan registrasi';
            }
        }
        
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil melakukan registrasi' : $error
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

    public function done()
    {
        return view('auth.done');
    }
}
