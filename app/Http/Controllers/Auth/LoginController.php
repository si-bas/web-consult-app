<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

# Models
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function getUserData(Request $request)
    {
        $code = preg_replace('/\s+/', '', $request->code);

        try {
            $user = User::where('code', $code)->first();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $error = 'Tidak ditemukan data dengan kode '.$code;
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil mendapatkan data' : $error,
            'data' => [
                'email' => $user->email ?? '',
                'password' => Crypt::decrypt($user->password_hint) ?? ''
            ]
        ]; 
    }
}
