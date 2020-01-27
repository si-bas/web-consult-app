<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Facades\Auth;

# Models
use App\Models\Schedule\Day;
use App\Models\Schedule\Lecturer;

class AvailabilityController extends Controller
{
    public function list()
    {
        return view('contents.schedule.availability.list');
    }

    public function data(Request $request)
    {
        $schedules = Lecturer::select(DB::raw('lecturer_schedules.*'))->with([
            'day'
        ]);

        if (Laratrust::hasRole('lecturer')) {
            $schedules->where('lecturer_id', Auth::user()->lecturer->id);
        }

        return DataTables::of($schedules)
        ->addColumn('action', function($schedule) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">                
                    <a class="dropdown-item" href="'.route('schedule.availability.form.update', ['id' => $schedule->id]).'"><i class="bx bxs-pencil mr-1"></i> ubah</a>
                    <hr>
                    <a class="dropdown-item" href="javascript:;" onclick="actionDelete('.$schedule->id.')"><i class="bx bx-trash mr-1"></i> hapus</a>
                </div>
            </div>';
        })
        ->rawColumns([
            'action'
        ])
        ->make(true);
    }

    public function formCreate()
    {
        return view('contents.schedule.availability.form-create');
    }

    public function create(Request $request)
    {
        try {
            $schedule = new Lecturer($request->all());
            $schedule->start_time = $request->start_time_submit;
            $schedule->end_time = $request->end_time_submit;

            $schedule->save();

            return redirect()->route('schedule.availability.list')->with('success', 'Berhasil membuat jadwal');
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('schedule.availability.list')->with('error', 'Terjadi kesalahan saat membuat jadwal');
    }

    public function formUpdate(Request $request)
    {
        $schedule = Lecturer::find($request->id)->load(['day']);

        return view('contents.schedule.availability.form-update', [
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request)
    {
        try {
            $schedule = Lecturer::find($request->id);
            $schedule->fill($request->all());
            $schedule->start_time = $request->start_time_submit;
            $schedule->end_time = $request->end_time_submit;

            $schedule->save();

            return redirect()->route('schedule.availability.list')->with('success', 'Berhasil mengubah jadwal');
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('schedule.availability.list')->with('error', 'Terjadi kesalahan saat mengubah jadwal');
    }

    public function delete(Request $request)
    {
        try {
            Lecturer::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat menghapus data jadwal';

            Log::error($e->getMessage());
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data jadwal' : $error
        ];
    }

    public function getDays(Request $request)
    {
        $query = Day::orderBy('id');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }
}
