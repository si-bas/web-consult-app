<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Models
use App\Models\Evaluation\Student_evaluation;

class FormController extends Controller
{
    public function fill()
    {
        if (Student_evaluation::where('student_id', Auth::user()->student->id)->count() == 0) {
            return view('contents.evaluation.form.fill');
        }

        return redirect()->route('questionnaire.post.done');
    }

    public function submit(Request $request)
    {
        Student_evaluation::updateOrCreate([
            "student_id" => Auth::user()->student->id
        ], array_merge($request->except('_token'), [
            "student_id" => Auth::user()->student->id
        ]));

        return redirect()->route('questionnaire.post.done');
    }
}
