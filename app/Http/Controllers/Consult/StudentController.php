<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

# Models
use App\User;
use App\Models\Schedule\Lecturer as Schedule;
use App\Models\Consultation\Consult;
use App\Models\Consultation\Message;

# Jobs
use App\Jobs\Chat\SaveReadMessages;
use App\Jobs\Chat\EmailUnreadMessage;

class StudentController extends Controller
{
    public function list()
    {
        if (Auth::user()->student->need_consult) {
            $consult = Consult::where('student_id', Auth::user()->student->id)
            ->withCount([
                'messages' => function($query) {
                    $query->whereDoesntHave('readers', function($query) {
                        $query->where('user_id', Auth::user()->id);
                    });
                }
            ])
            ->orderBy('updated_at', 'DESC')->first();

            if (empty($consult)) {
                return redirect()->route('consult.student.select.lecturer');
            }

            if ($consult->is_done) {
                return redirect()->route('questionnaire.post.check');
            }

            if (!$consult->is_meeting) {
                return redirect()->route('consult.student.chat', ['id' => $consult->id]);
            }            

            return view('contents.consult.student.list', [
                'consult' => $consult
            ]);
        }

        return view('contents.consult.student.congratulation');
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
            "is_meeting" => $request->is_meeting
        ]);

        return redirect()->route('consult.student.list', ['consult' => $consult->id]);
    }

    public function chat(Request $request)
    {
        $consult = Consult::find($request->id);

        if ($consult->is_done) {
            return redirect()->route('questionnaire.post.check');
        }

        return view('contents.consult.student.chat', [
            'consult' => $consult
        ]);
    }

    public function chatFirstLoad(Request $request)
    {
        $consult = Consult::find($request->id)->load([
            'messages' => function($query) {
                $query->latest()->take(5);
            }
        ]);

        dispatch(new SaveReadMessages($consult->messages->pluck('id'), Auth::user()->id, Carbon::now()->toDateTimeString()));

        return view('contents.consult.student.chat.first-load', [
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

    public function getMessagesMore(Request $request)
    {
        $consult = Consult::find($request->id)->load([
            'messages' => function($query) use($request) {
                $query->latest()->skip($request->skip)->take(5);
            }
        ]);

        if ($consult->messages->count() > 0) {
            dispatch(new SaveReadMessages($consult->messages->pluck('id'), Auth::user()->id, Carbon::now()->toDateTimeString()));
        }

        return [
            'view' => view('contents.consult.student.chat.more', [
                'consult' => $consult
            ])->render(),
            'count' => $consult->messages->count(),
            'skip' => $request->skip+5
        ];
    }

    public function saveMessage(Request $request)
    {
        $consult = Consult::find($request->id)->load([
            'student', 'lecturer'
        ]);
        $consult->updated_at = Carbon::now()->toDateTimeString();
        $consult->save();

        $message = Message::create([
            "consult_id" => $request->id,
            "user_id" => Auth::user()->id,
            "message" => $request->message
        ]);

        dispatch((new EmailUnreadMessage($consult->student->user_id, $consult->lecturer->user_id, $message->id))->delay(now()->addMinutes(15)));
    }

    public function getMessagesNew(Request $request)
    {
        $messages = Message::where('consult_id', $request->id)->whereHas('consult', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->where('id', '>', $request->max_id)->orderBy('id', 'ASC')->get();

        if ($messages->count() > 0) {
            dispatch(new SaveReadMessages($messages->pluck('id'), Auth::user()->id, Carbon::now()->toDateTimeString()));
        }

        return [
            'view' => view('contents.consult.student.chat.new', [
                'messages' => $messages
            ])->render(),

            'count' => $messages->count()
        ];
    }
}
