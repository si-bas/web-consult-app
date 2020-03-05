<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laratrust\LaratrustFacade as Laratrust;

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

        if (Laratrust::hasRole('student')) {
            if (!Auth::user()->student->approve_consent) {
                return redirect()->route('information.consent.form');
            }

            if (!Auth::user()->student->profile()->exists()) {
                return redirect()->route('profile.student.complete');
            }

            return redirect()->route('questionnaire.fill.check');
        }

        if (Laratrust::hasRole('lecturer')) {
            return redirect()->route('consult.lecturer.list');
        }

        return view('home');
    }
}
