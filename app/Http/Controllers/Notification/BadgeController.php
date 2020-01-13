<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\User;

class BadgeController extends Controller
{
    public function userUnverifiedCount()
    {
        $count = User::whereNull('verified_at')->count();

        return response()->json([
            'class' => $count > 0 ? 'badge badge-pill badge-round badge-danger float-right mr-2' : '',
            'count' => $count > 0 ? $count : ''
        ]);
    }
}
