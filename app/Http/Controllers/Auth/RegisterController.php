<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        if (!empty($request->email)) {
            if (User::where('email', $request->email)->count()) {
                $error = 'Error! Email telah digunakan, silahkan gunakan email lain';
            }
        }

        $base_code = $request->student_id_number.'-'.Carbon::now()->toDateTimeString();
        $code = Hash::make($base_code);
        $rand_string = $this->generateRandomString(4);

        try {
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email ?? $code.'@mailinator.com',
                'password' => $request->password ?? $base_code,
                'password_hint' => $request->password ?? $base_code,
                'code' => $rand_string
            ]);
            $user->attachRole('student');

            $full_name = $this->splitName($request->full_name); 
            $student = new Student([
                "first_name" => $full_name[0],
                "last_name" => $full_name[1],
                "student_id_number" => $request->student_id_number,
                "user_id" => $user->id
            ]);
            $student->save();

            if (!config('custom.student_verification') ?? false) {
                $user->verified_at = Carbon::now()->toDateTimeString();
                $user->save();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $error = 'Error! Terjadi kesalahan saat melakukan registrasi';
        }
           
        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil melakukan registrasi' : $error,
            'data' => [
                'code' => Crypt::encrypt($rand_string)
            ]
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

    public function done(Request $request)
    {
        return view('auth.done');
    }

    private function splitName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }

    private function generateRandomString($length = 4) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        while (true) {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $count = User::where('code', $randomString)->count();
            if ($count == 0) {
                break;
            }
        }

        return $randomString;
    }
}
