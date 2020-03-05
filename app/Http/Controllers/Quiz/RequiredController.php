<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequiredController extends Controller
{
    public function check()
    {
        return redirect()->route('content.required.check');
    }
}
