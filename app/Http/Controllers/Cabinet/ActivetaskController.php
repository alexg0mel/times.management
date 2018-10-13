<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\UseCases\Users\ApiTokenServices;

class ActivetaskController extends Controller
{
    public function index()
    {
        $token = (new ApiTokenServices(\Auth::user()))->getToken();
        return view('cabinet.userintask', ['token' => json_encode(['token' => $token])]);
    }

    public function index2()
    {
        $token = (new ApiTokenServices(\Auth::user()))->getToken();
        return view('cabinet.userintask2', ['token' => json_encode(['token' => $token])]);
    }


}
