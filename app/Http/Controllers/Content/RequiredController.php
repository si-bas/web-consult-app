<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

# Models
use App\Models\Content\Video;
use App\Models\Content\Student_video;

class RequiredController extends Controller
{
    public function check()
    {
        $video = Video::whereDoesntHave('viewers', function($query) {
            $query->where('student_id', Auth::user()->student->id);
        })->orderBy('code', 'ASC')->first();

        if (!empty($video)) {
            return redirect()->route('content.required.show.video', ['video' => Crypt::encrypt($video->id)]);
        }

        return redirect()->route('consult.student.list');
    }

    public function showVideo(Request $request)
    {
        try {
            $video = Video::find(Crypt::decrypt($request->video));
            
            return view('contents.content.required.video', [
                'video' => $video
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('content.required.check');
        }
    }

    public function nextVideo(Request $request)
    {
        try {
            $video_id = Crypt::decrypt($request->video);

            $viewer = Student_video::where('student_id', Auth::user()->student->id)->where('content_video_id', $video_id)->first() ?? new Student_video();
            $viewer->fill([
                "student_id" => Auth::user()->student->id,
                "content_video_id" => $video_id,
                "updated_at" => Carbon::now()->toDateTimeString()
            ]);

            $viewer->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('content.required.check');
    }
}
