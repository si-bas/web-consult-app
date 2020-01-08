<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'visit']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (empty(Auth::user()->verified_at)) {
            Auth::logout();
            return redirect('login')->with('warning', 'Akun belum diverifikasi oleh Administrator');
        }

        return view('home');
    }
}
