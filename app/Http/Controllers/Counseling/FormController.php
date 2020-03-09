<?php

namespace App\Http\Controllers\Counseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

# Models
use App\Models\Counseling\Question;
use App\Models\Counseling\Student_counseling;

class FormController extends Controller
{
    public function fill()
    {
        $check = Student_counseling::where('student_id', Auth::user()->student->id)->count() == 3;

        if (!$check) {
            $questions = Question::orderBy('order', 'ASC')->get();

            return view('contents.counseling.form.fill', [
                "questions" => $questions
            ]);
        } else {
            return redirect()->route('quiz.required.check');
        }
    }

    public function submit(Request $request)
    {
        try {
            foreach ($request->except('_token') as $id => $value) {
                Student_counseling::updateOrCreate([
                    "student_id" => Auth::user()->student->id,
                    "counseling_question_id" => $id
                ], [
                    "student_id" => Auth::user()->student->id,
                    "counseling_question_id" => $id,
                    "answer" => $value,
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('counseling.form.fill');
        }

        return redirect()->route('quiz.required.check');
    }
}
