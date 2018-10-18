<?php

namespace Tests\Unit;


use App\DTO\DHMObject;
use App\Helpers\DateTimeHelper;
use Tests\TestCase;

class DateTimeHelperTest extends TestCase
{
    public function testDHMtoM()
    {
        $timespan = new DHMObject();
        $timespan->days = 1;
        $timespan->hours = 2;
        $timespan->minutes=3;

        self::assertEquals(1563,DateTimeHelper::DHMtoM($timespan));

    }



    public function testMtoDHM()
    {
        /** @var DHMObject $timespan */
        $timespan = DateTimeHelper::MtoDHM(1563);

        self::assertEquals(1,$timespan->days);
        self::assertEquals(2,$timespan->hours);
        self::assertEquals(3,$timespan->minutes);

    }


}