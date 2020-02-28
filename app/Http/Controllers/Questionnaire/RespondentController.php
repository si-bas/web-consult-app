<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Student_questionnaire;

class RespondentController extends Controller
{
    public function list()
    {
        return view('contents.questionnaire.respondent.list');
    }

    public function data(Request $request)
    {
        $respondents = Student_questionnaire::select(DB::raw('student_questionnaire.*'))->with([
            'student.user', 'questionnaire'
        ]);

        return DataTables::of($respondents)
        ->addColumn('action', '')
        ->make(true);
    }
}
