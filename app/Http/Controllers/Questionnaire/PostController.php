<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Student_questionnaire;

class PostController extends Controller
{
    public function check()
    {
        $questionnaire = Questionnaire::whereDoesntHave('student_questionnaire', function($query) {
            $query->where('student_id', Auth::user()->student->id)->where('status', 'post');
        })->orderBy('code', 'ASC')->first(); 

        if (!empty($questionnaire)) {
            return redirect()->route('questionnaire.post.form', ['questionnaire' => Crypt::encrypt($questionnaire->id)]);
        } 

        return redirect()->route('questionnaire.post.done'); 
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

            return view('contents.questionnaire.post.form-questionnaire', [
                'questionnaire' => $questionnaire
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('questionnaire.post.check');
        }
    }

    public function submit(Request $request)
    {
        $questionnaire = Student_questionnaire::create([
            "student_id" => Auth::user()->student->id,
            "questionnaire_id" => $request->questionnaire_id,
            "status" => "post"
        ]);

        foreach ($request->answers as $key => $value) {
            if (is_array($value)) {
                $questionnaire->student_answers()->create([
                    "questionnaire_question_id" => $key,
                    "answer" => implode(",",$value),
                ]);
            } else {
                $questionnaire->student_answers()->create([
                    "questionnaire_question_id" => $key,
                    "answer" => $value,
                ]);
            }
        }

        try {
            $poin = Student_questionnaire::where('id', $questionnaire->id)->withCount([
                'student_answers AS poin_sum' => function($query) {
                    $query->select(DB::raw("SUM(poin) as poinsum"))->join('questionnaire_answers', 'student_questionnaire_answer.answer', '=', 'questionnaire_answers.id');
                }
            ])->first()->poin_sum;

        } catch (\Exception $e) {
            Log::warning($e->getMessage());

            $poin = 0;
        }

        foreach ($questionnaire->questionnaire->results as $result) {
            if ($poin >= $result->score_from && $poin <= $result->score_to) {
                $questionnaire->questionnaire_result_id = $result->id;
                break;
            }
        }

        $questionnaire->save();

        return redirect()->route('questionnaire.post.check');
    }

    public function done()
    {
        return view('contents.questionnaire.post.done');
    }
}
