<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Models
use App\User;

class StudentController extends Controller
{
    public function list()
    {
        $user = User::find(Auth::id())->load([
            'student.major.faculty', 'student.profile' => function($query) { $query->with(['gender', 'solving_options']); }
        ]);

        return view('contents.consult.student.test', [
            'user' => $user
        ]);
    }
}
