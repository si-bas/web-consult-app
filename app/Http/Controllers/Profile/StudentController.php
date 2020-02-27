<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

# Models
use App\User;
use App\Models\Questionnaire\Problem_solving_option;
use App\Models\Profile\Student;
use App\Models\University\Major;

class StudentController extends Controller
{
    public function complete()
    {
        $solving_options = Problem_solving_option::get();
        $user = User::find(Auth::id())->load([
            'student.major.faculty'
        ]);

        return view('contents.profile.student.complete', [
            'solving_options' => $solving_options,
            'user' => $user
        ]);
    }

    public function create(Request $request)
    {
        try {
            $user = User::find(Auth::id())->load([
                'student.major'
            ]);
                
            $profile = $user->student->profile()->create($request->all());
            foreach ($request->options as $option_id) {
                $profile->solving_options()->attach($option_id);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('home');
    }

    public function detail()
    {
        $user = User::find(Auth::id())->load([
            'student.major.faculty', 'student.profile' => function($query) { $query->with(['gender', 'solving_options']); }
        ]);

        return view('contents.profile.student.detail', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        try {
            $student = Student::find($request->student_id);
            $student->fill($request->all());
            $student->save();

            $student->user->email = $request->email;
            if (!empty($request->password)) {
                $student->user->password = $request->password;
                $student->user->password_hint = $request->password;
            }
            $student->user->name = $request->first_name.' '.$request->last_name;
            $student->user->save();

            return redirect()->route('profile.student.detail')->with('success', 'Berhasil mengubah data profil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('profile.student.detail')->with('error', 'Terjadi kesalahan saat mengubah data profil');
    }
    
    public function getMajors(Request $request)
    {
        $query = Major::orderBy('name')->has('faculty')->with([
            'faculty'
        ]);

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        if (!empty($request->faculty_id)) {
            $query->where('faculty_id', $request->faculty_id);
        }

        return $query->get(['id', 'name as text', 'faculty_id']);
    }
}
