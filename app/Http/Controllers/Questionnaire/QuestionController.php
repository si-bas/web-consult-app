<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Question;

class QuestionController extends Controller
{
    public function formCreate(Request $request)
    {
        $questionnaire = Questionnaire::find($request->id);
    }
}
