<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\View\Student_activity;
use App\Models\Questionnaire\Questionnaire;

# Jobs
use App\Jobs\Email\SendCustomMessage;

class ActivityController extends Controller
{
    public function list()
    {
        return view('contents.report.activity.list');
    }

    public function data(Request $request)
    {
        $count_questionnaire = Questionnaire::count();
        $students = Student_activity::select(DB::raw('student_activity.*, CONCAT(first_name, \' \',last_name) as full_name'))->withCount([
            'evaluation'
        ]);

        if (!empty($request->status)) {
            $students->where('need_consult', $request->status);
        }

        if (!empty($request->name_nim)) {
            $students->where(function($query) use($request) {
                $query->whereRaw('CONCAT(first_name, \' \',last_name) '. 'LIKE'. " '%$request->name_nim%'")->orWhere('student_id_number', 'LIKE', "%$request->name_nim%");
            });
        }

        return DataTables::of($students)        
        ->editColumn('count_pre', function($student) use($count_questionnaire) {
            return $student->count_pre == $count_questionnaire ? '<i class="bx bx-check font-medium-3"></i>' : '<i class="bx bx-x font-medium-3"></i>';
        })
        ->editColumn('count_post', function($student) use($count_questionnaire) {
            return $student->count_post == $count_questionnaire ? '<i class="bx bx-check font-medium-3"></i>' : '<i class="bx bx-x font-medium-3"></i>';
        })
        ->editColumn('is_done', function($student) {
            if ($student->is_done !== NULL) {
                return $student->is_done ? '<i class="bx bx-check font-medium-3"></i>' : '<i class="bx bx-conversation font-medium-3"></i>';
            }

            if ($student->need_consult) {
                return '<i class="bx bx-x font-medium-3"></i>';
            }

            return '-';
        })
        ->editColumn('need_consult', function($student) {
            return $student->need_consult ? 'Kuning' : 'Hijau';
        })
        ->editColumn('evaluation_count', function($student) {
            return $student->evaluation_count > 0 ? '<i class="bx bx-check font-medium-3"></i>' : '<i class="bx bx-x font-medium-3"></i>';
        })
        ->addColumn('action', '')
        ->rawColumns([
            'count_pre', 'count_post', 'is_done', 'action', 'evaluation_count'
        ])
        ->make(true);
    }

    public function send(Request $request)
    {
        dispatch(new SendCustomMessage($request->all()));

        return redirect()->route('report.activity.list')->with('success', 'Email sedang dalam proses pengiriman');
    }
}
