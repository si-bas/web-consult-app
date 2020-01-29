<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;


# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Student_questionnaire;

class FillController extends Controller
{
    public function check()
    {
        $questionnaire = Questionnaire::whereDoesntHave('student_questionnaire', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->orderBy('code', 'ASC')->first(); 

        if (!empty($questionnaire)) {
            return redirect()->route('questionnaire.fill.form', ['questionnaire' => Crypt::encrypt($questionnaire->id)]);
        } 

        return redirect()->route('consult.student.list');
    }

    public function form(Request $request)
    {
        try {
            $questionnaire = Questionnaire::find(Crypt::decrypt($request->questionnaire))->load([
                'questions' => function($query) {
                    $query->with([
                        'answers'
                    ]);
                }
            ]);

            return view('contents.questionnaire.fill.form-questionnaire', [
                'questionnaire' => $questionnaire
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('questionnaire.fill.check');
        }
    }

    public function submit(Request $request)
    {
        $querstionnaire = Student_questionnaire::create([
            "student_id" => Auth::user()->student->id,
            "questionnaire_id" => $request->questionnaire_id,
        ]);

        foreach ($request->answers as $key => $value) {
            if (is_array($value)) {
                $querstionnaire->student_answers()->create([
                    "questionnaire_question_id" => $key,
                    "answer" => implode(",",$value),
                ]);
            } else {
                $querstionnaire->student_answers()->create([
                    "questionnaire_question_id" => $key,
                    "answer" => $value,
                ]);
            }
        }

        return redirect()->route('questionnaire.fill.check');
    }
}
