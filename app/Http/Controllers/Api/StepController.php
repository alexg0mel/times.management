<?php

namespace App\Http\Controllers\Api;

use App\UseCases\TimeServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StepController extends Controller
{

    public function tasks(Request $request)
    {
        return TimeServices::New($request->user())->getTasks();
    }

    public function startTime(Request $request, $group, $task )
    {
        return TimeServices::New($request->user())->startTime($group, $task);
    }

    public function getTime(Request $request)
    {
        return TimeServices::New($request->user())->getTime();
    }


    public function putOpis(Request $request)
    {
        TimeServices::New($request->user())->setOpis($request->json('step_opis'));
        return;
    }

    public function stopTime(Request $request)
    {
        TimeServices::New($request->user())->stopTime();
    }

}
