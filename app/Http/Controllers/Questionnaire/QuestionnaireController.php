<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\Questionnaire\Questionnaire;

class QuestionnaireController extends Controller
{
    public function list()
    {
        return view('contents.questionnaire.questionnaire.list');
    }

    public function data(Request $request)
    {
        $questionnaires = Questionnaire::select(DB::raw('questionnaires.*'))->withCount([
            'questions', 'student_questionnaire'
        ]);

        return DataTables::of($questionnaires)
        ->editColumn('name', function($questionnaire) {
            return '<a href="'.route('questionnaire.detail', ['id' => $questionnaire->id]).'">'.$questionnaire->name.'</a>';
        })
        ->editColumn('is_active', function($questionnaire) {
            return $questionnaire->is_active ? '<span class="text-success">Aktif</span>' : '<span class="text-danger">Nonaktif</span>';
        })
        ->editColumn('is_required', function($questionnaire) {
            return $questionnaire->is_required ? '<span class="text-success">Ya</span>' : '<span class="text-danger">Tidak</span>';
        })
        ->addColumn('action', function($questionnaire) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="'.route('questionnaire.detail', ['id' => $questionnaire->id]).'"><i class="bx bxs-user-detail mr-1"></i> rincian</a>                    
                </div>
            </div>';
        })
        ->rawColumns([
            'is_active', 'is_required', 'action', 'name'
        ])
        ->make(true);
    }

    public function detail(Request $request)
    {
        $questionnaire = Questionnaire::find($request->id)->load([
            'user'
        ]);
        
        return view('contents.questionnaire.questionnaire.detail', [
            'questionnaire' => $questionnaire
        ]);
    }

    public function create(Request $request)
    {
        try {
            $questionnaire = new Questionnaire($request->all());
            $questionnaire->is_required = true;
            $questionnaire->is_active = true;
            $questionnaire->save();

            return redirect()->route('questionnaire.detail', ['id' => $questionnaire->id]);
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('questionnaire.list')->with(empty($error) ? 'success' : 'error', empty($error) ? 'Berhasil menyimpan data Kuesioner!' : 'Terjadi kesalahan saat menyimpan data Kuesioner!');
    }

    public function update(Request $request)
    {
        try {
            $questionnaire = Questionnaire::find($request->id);
            $questionnaire->fill($request->all());
            $questionnaire->save();

            return redirect()->route('questionnaire.detail', ['id' => $questionnaire->id])->with('success', 'Berhasil menyimpan perubahan data Kuesioner');
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('questionnaire.list')->with('error', 'Terjadi kesalahan saat menyimpan data Kuesioner!');
    }
}
