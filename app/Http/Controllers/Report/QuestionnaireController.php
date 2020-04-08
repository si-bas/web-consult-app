<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\Questionnaire\Student_questionnaire;

# Jobs
use App\Jobs\Report\QuestionairreScoreExcel;

class QuestionnaireController extends Controller
{
    public function list()
    {
        return view('contents.report.questionnaire.list');
    }

    public function data(Request $request)
    {
        $results = Student_questionnaire::select(DB::raw('student_questionnaire.*'))
        ->with([
            'result', 'student.user', 'questionnaire'
        ])
        ->withCount([
            'student_answers as sum_score' => function($query) {
                $query->select(DB::raw('SUM(questionnaire_answers.poin) as sum_score'))->join('questionnaire_answers', 'student_questionnaire_answer.answer', '=', 'questionnaire_answers.id');
            }
        ]);

        return DataTables::of($results)
        ->addColumn('action', function($result) {
            return '<a href="'.route('questionnaire.respondent.download', ['id' => $result->id]).'" class="btn btn-success btn-sm">Unduh</a>';
        })
        ->rawColumns([
            'action'
        ])
        ->make(true);
    }

    public function generate(Request $request)
    {
        try {
            dispatch(new QuestionairreScoreExcel($request->email, $request->category));
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat membuat laporan';
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Laporan dalam proses pembuatan dan pengiriman' : $error
        ];
    }
}
