<?php

namespace App\Http\Controllers\Api;

use App\UseCases\Reports\UserDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserReportController extends Controller
{

    public function day(Request $request, int $day, int $month, int $year)
    {
        $user = $request->user();
        $date = new Carbon($day.'-'.$month.'-'.$year);
        $reportService = new UserDay($user);
        return $reportService->report($date);
    }

}
