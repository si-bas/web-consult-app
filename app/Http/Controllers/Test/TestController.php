<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\Profile\Student;

class TestController extends Controller
{
    public function test()
    {
        $students = Student::has('profile')->with([
            'profile', 'filled_questionnaires' => function($query) {
                $query->withCount([
                    'student_answers AS score_sum' => function($query) {
                        $query->select(DB::raw('SUM(questionnaire_answers.poin) as scoresum'))->join('questionnaire_answers', 'student_questionnaire_answer.answer', '=', 'questionnaire_answers.id');
                    }
                ])->where('status', 'pre')->with([
                    'questionnaire'
                ]);
            }
        ])->where('need_consult', true)->limit(10)->get();

        return $students;
    }
}
