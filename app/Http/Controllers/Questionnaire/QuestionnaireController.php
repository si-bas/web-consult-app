<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function list()
    {
        return view('contents.questionnaire.questionnaire.list');
    }

    public function data(Request $request)
    {
        # code...
    }

    public function create(Request $request)
    {
        return $request->all();
    }
}
