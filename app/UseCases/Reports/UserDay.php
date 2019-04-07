<?php

namespace App\UseCases\Reports;

use App\Entity\User;
use Carbon\Carbon;
use App\Entity\Time;

class UserDay
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function report(Carbon $date)
    {
        $endday = clone $date;
        $endday->addDay(1)->addSecond(-1);
        $timeReport = Time::whereUserId($this->user->id)->whereNotNull('end_time')
            ->whereBetween('end_time', [$date, $endday])
            ->with('task')->with('task.project')
            ->select(['task_id', 'step_opis' ])->selectRaw('sum(fact_time) as fact_time')
            ->groupBy(['task_id', 'step_opis'])->get();

        return $timeReport;
    }

}