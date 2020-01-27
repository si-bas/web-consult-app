<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Laratrust\LaratrustFacade as Laratrust;

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
        $schedules = Lecturer::select(DB::raw('lecturer_schedules.*'));

        if (Laratrust::hasRole('lecturer')) {
            # code...
        }

        return DataTables::of($schedules);
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

    public function getDays(Request $request)
    {
        $query = Day::orderBy('id');

        if (!empty($request->search)) {
            $query->where('name', 'LIKE', "%$request->search%");
        }

        return $query->get(['id', 'name as text']);
    }
}
