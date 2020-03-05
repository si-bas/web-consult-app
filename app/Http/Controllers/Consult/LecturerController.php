<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

# Models
use App\Models\Consultation\Consult;
use App\Models\Consultation\Message;
use App\Models\Schedule\Lecturer as Schedule;

# Jobs
use App\Jobs\Chat\SaveReadMessages;
use App\Jobs\Chat\EmailUnreadMessage;

class LecturerController extends Controller
{
    public function list()
    {
        $consults = Consult::where('lecturer_id', Auth::user()->lecturer->id)
        ->withCount([
            'messages' => function($query) {
                $query->whereDoesntHave('readers', function($query) {
                    $query->where('user_id', Auth::user()->id);
                });
            }
        ])
        ->orderBy('updated_at', 'DESC')->get();

        return view('contents.consult.lecturer.list', [
            'consults' => $consults,
            'has_schedule' => Schedule::where('lecturer_id', Auth::user()->lecturer->id)->count() > 0
        ]);
    }

    public function chat(Request $request)
    {
        $consult = Consult::find($request->id);

        return view('contents.consult.lecturer.chat', [
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

        return view('contents.consult.lecturer.chat.first-load', [
            'consult' => $consult
        ]);
    }

    public function getMessages(Request $request)
    {
        $consult = Consult::find($request->id)->load([
            'schedule.day', 'lecturer', 'messages'
        ]);

        return view('contents.consult.lecturer.messages-list', [
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
            'view' => view('contents.consult.lecturer.chat.more', [
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
            $query->where('lecturer_id', Auth::user()->lecturer->id);
        })->where('id', '>', $request->max_id)->orderBy('id', 'ASC')->get();

        if ($messages->count() > 0) {
            dispatch(new SaveReadMessages($messages->pluck('id'), Auth::user()->id, Carbon::now()->toDateTimeString()));
        }

        return [
            'view' => view('contents.consult.lecturer.chat.new', [
                'messages' => $messages
            ])->render(),

            'count' => $messages->count()
        ];
    }
}
