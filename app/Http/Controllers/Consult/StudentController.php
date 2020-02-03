<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Models
use App\User;
use App\Models\Profile\Lecturer;

class StudentController extends Controller
{
    public function list()
    {
        $user = User::find(Auth::id())->load([
            'student.major.faculty', 'student.profile' => function($query) { $query->with(['gender', 'solving_options']); }
        ]);

        $avail_lecturers = Lecturer::with([
            'major.faculty'
        ])->get();

        return view('contents.consult.student.test', [
            'user' => $user,
            'avail_lecturers' => $avail_lecturers
        ]);
    }
}
