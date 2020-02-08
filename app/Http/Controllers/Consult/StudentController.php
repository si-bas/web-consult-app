<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\User;
use App\Models\Profile\Lecturer;
use App\Models\Schedule\Lecturer as Schedule;
use App\Models\Consultatation\Consult;
use App\Models\Consultatation\Message;

class StudentController extends Controller
{
    public function list()
    {
        $consults = Consult::where('student_id', Auth::user()->student->id)->get();

        return view('contents.consult.student.list', [
            'consults' => $consults
        ]);
    }
    
    public function selectLecturer()
    {
        return view('contents.consult.student.select-lecturer');
    }
    
    public function dataLecturer(Request $request)
    {
        $users = User::select(DB::raw('users.*'))->has('lecturer')->with([
            'lecturer.gender', 'lecturer.major.faculty'
        ]);

        return DataTables::of($users)
        ->editColumn('name', function($user) {
            return '<a href="javascript:;" onclick="showDetail('.$user->id.')">'.$user->name.'</a>';
        })
        ->addColumn('action', function($user) {
            return '<button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm" onclick="showDetail('.$user->id.')">Pilih</button>';
        })
        ->rawColumns([
            'action', 'name'
        ])
        ->make(true);
    }

    public function detailLecturer(Request $request)
    {
        $user = User::find($request->id)->load([
            'lecturer.major.faculty',
            'lecturer.gender'
        ]);

        $schedules = Schedule::where('lecturer_id', $user->lecturer->id)->with([
            'day'
        ])->get();

        return view('contents.consult.student.detail-lecturer', [
            'user' => $user,
            'schedules' => $schedules
        ]);
    }

    public function selectSchedule(Request $request)
    {
        $schedule = Schedule::find($request->id);

        $consult = Consult::create([
            "lecturer_id" => $schedule->lecturer_id,
            "student_id" => Auth::user()->student->id,
            "lecturer_schedule_id" => $schedule->id,
        ]);

        return redirect()->route('consult.student.list', ['consult' => $consult->id]);
    }

    public function chat(Request $request)
    {
        $consult = Consult::find($request->id);

        return view('contents.consult.student.chat', [
            'consult' => $consult
        ]);
    }

    public function getMessages(Request $request)
    {
        $consult = Consult::find($request->id)->load([
            'schedule.day', 'lecturer', 'messages'
        ]);

        return view('contents.consult.student.messages-list', [
            'consult' => $consult
        ]);
    }

    public function saveMessage(Request $request)
    {
        Message::create([
            "consult_id" => $request->id,
            "user_id" => Auth::user()->id,
            "message" => $request->message
        ]);
    }
}
