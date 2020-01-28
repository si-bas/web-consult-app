<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Models
use App\User;
use App\Models\Questionnaire\Problem_solving_option;

class StudentController extends Controller
{
    public function complete()
    {
        $solving_options = Problem_solving_option::get();
        $user = User::find(Auth::id())->load([
            'student.major'
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
}
