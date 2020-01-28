<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

# Models
use App\Models\Questionnaire\Questionnaire;

class FillController extends Controller
{
    public function check()
    {
        $questionnaire = Questionnaire::orderBy('code', 'ASC')->first(); 

        if (!empty($questionnaire)) {
            return redirect()->route('questionnaire.fill.form', ['questionnaire' => Crypt::encrypt($questionnaire->id)]);
        } 
    }

    public function form(Request $request)
    {
        try {
            return $questionnaire = Questionnaire::find(Crypt::decrypt($request->questionnaire));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('questionnaire.fill.check');
        }
    }
}
