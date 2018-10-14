<?php

namespace Tests\Unit;

use App\UseCases\Timelines\Statuses\Active;
use App\UseCases\Timelines\Statuses\Complete;
use App\UseCases\Timelines\Statuses\Drafting;
use App\UseCases\Timelines\Statuses\Planing;
use App\UseCases\Timelines\Statuses\TimelinesStatuses;
use App\UseCases\Timelines\Statuses\Wait;
use Tests\TestCase;
use App\Entity\Timeline;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineTest extends TestCase
{


    public function testCreate()
    {
        $current = Carbon::now();
        $testline = Timeline::new($start_time=$current->addDay(2),
            $end_time=$current->addDay(12));

        self::assertNotEmpty($testline);

        self::assertEquals($testline->start_time,$start_time);
        self::assertEquals($testline->end_time,$end_time);
        self::assertEquals($testline->status, Drafting::getName());

    }

    public function testNewStatus()
    {
        $current = Carbon::now();
        $testline = Timeline::new($current, $current);
        $timelineStatuses = new TimelinesStatuses($testline);

        $timelineStatuses->setPlaning();

        self::assertEquals($timelineStatuses->getTimelines()->status, Planing::getName());

        self::expectExceptionMessage('This status is already set.');
        $timelineStatuses->setPlaning();

    }

    public function testWait()
    {
        $current = Carbon::now();
        $testline = Timeline::new($current, $current);
        $nottestline = clone  $testline;
        $timelineStatuses = new TimelinesStatuses($testline);

        $timelineStatuses->setWait();

        self::assertEquals($timelineStatuses->getTimelines()->status, Wait::getName());

        $timelineStatuses = new TimelinesStatuses($nottestline);
        self::assertEquals($timelineStatuses->getTimelines()->status, Drafting::getName());
        $timelineStatuses->setPlaning();
        self::expectExceptionMessage('Original status is not a draft.');
        $timelineStatuses->setWait();
    }

    public function testActive()
    {
        $current = Carbon::now();
        $testline = Timeline::new($current, $current);
        $nottestline = clone  $testline;
        $timelineStatuses = new TimelinesStatuses($testline);

        $timelineStatuses->setPlaning();
        $timelineStatuses->setActive();

        self::assertEquals($timelineStatuses->getTimelines()->status, Active::getName());

        $timelineStatuses = new TimelinesStatuses($nottestline);
        self::assertEquals($timelineStatuses->getTimelines()->status, Drafting::getName());
        self::expectExceptionMessage('Original status is not a planned.');
        $timelineStatuses->setActive();
    }

    public function testComplete()
    {
        $current = Carbon::now();
        $testline = Timeline::new($current, $current);
        $nottestline = clone  $testline;
        $timelineStatuses = new TimelinesStatuses($testline);

        $timelineStatuses->setPlaning();
        $timelineStatuses->setActive();
        $timelineStatuses->setComplete();

        self::assertEquals($timelineStatuses->getTimelines()->status, Complete::getName());

        $timelineStatuses = new TimelinesStatuses($nottestline);
        self::assertEquals($timelineStatuses->getTimelines()->status, Drafting::getName());
        self::expectExceptionMessage('Unable to complete inactive.');
        $timelineStatuses->setComplete();
    }

    public function testPlanning()
    {
        $current = Carbon::now();
        $testline = Timeline::new($current, $current);
        $nottestline = clone  $testline;
        $timelineStatuses = new TimelinesStatuses($testline);

        $timelineStatuses->setWait();
        $timelineStatuses->setPlaning();

        self::assertEquals($timelineStatuses->getTimelines()->status, Planing::getName());

        $timelineStatuses = new TimelinesStatuses($nottestline);
        self::assertEquals($timelineStatuses->getTimelines()->status, Drafting::getName());
        $timelineStatuses->setPlaning();
        $timelineStatuses->setActive();

        self::expectExceptionMessage('Unable to change active status.');
        $timelineStatuses->setPlaning();

        $timelineStatuses->setComplete();

        self::expectExceptionMessage('Unable to change completed status.');
        $timelineStatuses->setPlaning();

    }



}
