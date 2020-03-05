<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsentController extends Controller
{
    public function form()
    {
        return view('contents.information.consent.form');
    }

    public function agree()
    {
        $student = Auth::user()->student;
        $student->approve_consent = true;
        $student->save();

        return redirect()->route('home');
    }
}
