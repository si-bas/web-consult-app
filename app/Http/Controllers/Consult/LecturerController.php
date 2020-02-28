<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
# Models
use App\Models\Consultatation\Consult;
use App\Models\Consultatation\Message;

class LecturerController extends Controller
{
    public function list()
    {
        $consults = Consult::where('lecturer_id', Auth::user()->lecturer->id)->orderBy('updated_at', 'DESC')->get();

        return view('contents.consult.lecturer.list', [
            'consults' => $consults
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
        Consult::where('id', $request->id)->update([
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        Message::create([
            "consult_id" => $request->id,
            "user_id" => Auth::user()->id,
            "message" => $request->message
        ]);
    }

    public function getMessagesNew(Request $request)
    {
        $messages = Message::where('consult_id', $request->id)->whereHas('consult', function($query) {
            $query->where('lecturer_id', Auth::user()->lecturer->id);
        })->where('id', '>', $request->max_id)->orderBy('id', 'ASC')->get();

        return [
            'view' => view('contents.consult.lecturer.chat.new', [
                'messages' => $messages
            ])->render(),

            'count' => $messages->count()
        ];
    }
}
