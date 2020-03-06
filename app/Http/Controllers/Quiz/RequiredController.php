<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Models
use App\Models\Quiz\Quiz;
use App\Models\Quiz\Student_quiz;

class RequiredController extends Controller
{
    public function check()
    {
        return redirect()->route('quiz.required.quiz.one');
    }

    public function quiz1()
    {
        $quiz = Quiz::whereDoesntHave('student_quiz', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->where('code', 1)->first();

        if (!empty($quiz)) {
            return view('contents.quiz.custom.quiz-1', [
                'quiz' => $quiz
            ]);
        }

        return redirect()->route('quiz.required.quiz.two');
    }

    public function quiz1Submit(Request $request)
    {          
        $quiz = Student_quiz::where('quiz_id', $request->quiz_id)->where('student_id', Auth::user()->student->id)->first() ?? new Student_quiz();
        $quiz->fill([
            "quiz_id" => $request->quiz_id,
            "student_id" => Auth::user()->student->id,
            "result_html" => view('contents.quiz.custom.quiz-1-result', [
                'data' => (object) $request->all()
            ])->render(),
            "result_json" => $request->all()
        ]);
        $quiz->save();

        return redirect()->route('quiz.required.quiz.two');
    }

    public function quiz2()
    {
        $quiz = Quiz::whereDoesntHave('student_quiz', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->where('code', 2)->first();

        if (!empty($quiz)) {
            return view('contents.quiz.custom.quiz-2', [
                'quiz' => $quiz
            ]);
        }

        return redirect()->route('quiz.required.quiz.three');
    }

    public function quiz2Submit(Request $request)
    {
        $quiz = Student_quiz::where('quiz_id', $request->quiz_id)->where('student_id', Auth::user()->student->id)->first() ?? new Student_quiz();
        $quiz->fill([
            "quiz_id" => $request->quiz_id,
            "student_id" => Auth::user()->student->id,
            "result_html" => view('contents.quiz.custom.quiz-2-result', [
                'data' => (object) $request->all()
            ])->render(),
            "result_json" => $request->all()
        ]);
        $quiz->save();

        return redirect()->route('quiz.required.quiz.three');
    }

    public function quiz3()
    {
        $quiz = Quiz::whereDoesntHave('student_quiz', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->where('code', 3)->first();

        if (!empty($quiz)) {
            return view('contents.quiz.custom.quiz-3', [
                'quiz' => $quiz
            ]);
        }

        return redirect()->route('content.required.powerpoint');
    }

    public function quiz3Submit(Request $request)
    {
        $quiz = Student_quiz::where('quiz_id', $request->quiz_id)->where('student_id', Auth::user()->student->id)->first() ?? new Student_quiz();
        $quiz->fill([
            "quiz_id" => $request->quiz_id,
            "student_id" => Auth::user()->student->id,
            "result_html" => view('contents.quiz.custom.quiz-3-result', [
                'data' => (object) $request->all()
            ])->render(),
            "result_json" => $request->all()
        ]);
        $quiz->save();

        return redirect()->route('content.required.powerpoint');
    }
}
