<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class ActivetaskController extends Controller
{
    public function index()
    {
        return view('cabinet.userintask');
    }
}
