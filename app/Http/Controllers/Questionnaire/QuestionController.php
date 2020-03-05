<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Question;
use App\Models\Questionnaire\Answer;

class QuestionController extends Controller
{
    public function formCreate(Request $request)
    {
        $questionnaire = Questionnaire::find($request->questionnaire);

        return view('contents.questionnaire.question.form-create', [
            'questionnaire' => $questionnaire
        ]);
    }

    public function create(Request $request)
    {
        try {
            $question = new Question($request->all());
            $question->save();

            if ($question->type != 'free_text') {
                foreach ($request->answers as $answer) {
                    $question->answers()->create([
                        "text" => $answer['answer_text'],
                        "type" => $question->type == 'single_select' ? 'radio' : 'checkbox',
                        "poin" => $answer['answer_poin']
                    ]);
                }
            }

            return redirect()->route('questionnaire.detail', ['id' => $question->questionnaire_id])->with('success', 'Berhasil menyimpan Pertanyaan baru');
        } catch (\Exception $e) {
            $error = $e->getMessage();  

            Log::error($error);
        }

        return redirect()->route('questionnaire.detail', ['id' => $request->questionnaire_id])->with('error', 'Terjadi kesalahan saat menyimpan Pertanyaan baru');
    }

    public function formUpdate(Request $request)
    {
        $question = Question::find($request->id);

        return view('contents.questionnaire.question.form-update', [
            'question' => $question
        ]);
    }

    public function update(Request $request)
    {
        $question = Question::find($request->id);
        $question->fill($request->all());

        if ($question->type != 'free_text') {
            $answer_ids = collect($request->answers)->pluck('answer_id');
            Answer::where('questionnaire_question_id', $question->id)->whereNotIn('id', $answer_ids)->delete();

            foreach ($request->answers as $answer) {
                if (!empty($answer['answer_id'])) {
                    $answer_db = Answer::find($answer['answer_id']);
                    $answer_db->fill([
                        "text" => $answer['answer_text'],
                        "type" => $question->type == 'single_select' ? 'radio' : 'checkbox',
                        "poin" => $answer['answer_poin']
                    ]);
                    $answer_db->save();
                } else {
                    $question->answers()->create([
                        "text" => $answer['answer_text'],
                        "type" => $question->type == 'single_select' ? 'radio' : 'checkbox',
                        "poin" => $answer['answer_poin']
                    ]);
                }
            }
        } else {
            $question->answers()->delete();
        }

        $question->save();

        return redirect()->route('questionnaire.detail', ['id' => $question->questionnaire_id])->with('success', 'Berhasil menyimpan perubahan data pertanyaan');
    }

    public function data(Request $request)
    {
        $questions = Question::select(DB::raw('questionnaire_questions.*'));

        if (!empty($request->questionnaire_id)) {
            $questions->where('questionnaire_id', $request->questionnaire_id);
        }

        return DataTables::of($questions)
        ->editColumn('text', function($question) {
            return '<span onclick="showDetail('.$question->id.')">'.$question->text.'</span>';
        })
        ->addColumn('action', function($question) {
            return 
            '<div class="dropdown">
                <span class="bx bxs-cog font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;" onclick="showDetail('.$question->id.')"><i class="bx bxs-detail mr-1"></i> rincian</a>                    
                    <a class="dropdown-item" href="'.route('questionnaire.question.form.update', ['id' => $question->id]).'"><i class="bx bxs-pencil mr-1"></i> ubah</a>
                    <hr>
                    <a class="dropdown-item" href="javascript:;" onclick="actionDelete('.$question->id.')"><i class="bx bx-trash mr-1"></i> hapus</a>
                </div>
            </div>';
        })
        ->rawColumns([
            'action', 'text'
        ])
        ->make(true);
    }

    public function detailModal(Request $request)
    {
        $question =  Question::find($request->id)->load([
            'answers', 'questionnaire'
        ]);

        return view('contents.questionnaire.question.detail-modal', [
            'question' => $question
        ]);
    }

    public function delete(Request $request)
    {
        try {
            Question::where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $error = 'Error! Terjadi kesalahan saat menghapus data pertanyaan';

            Log::error($e->getMessage());
        }

        return [
            'status' => empty($error) ? 'success' : 'error',
            'message' => empty($error) ? 'Berhasil menghapus data pertanyaan' : $error
        ];
    }
}
