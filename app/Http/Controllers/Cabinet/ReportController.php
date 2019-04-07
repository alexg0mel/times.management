<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\UseCases\Users\ApiTokenServices;

class ReportController extends Controller
{
    public function report()
    {
        $token = (new ApiTokenServices(\Auth::user()))->getToken();
        return view('cabinet.report', ['token' => json_encode(['token' => $token])]);
    }
}
