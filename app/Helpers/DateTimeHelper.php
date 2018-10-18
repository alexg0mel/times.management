<?php

namespace App\Helpers;


use App\DTO\DHMObject;

class DateTimeHelper
{
    public static function DHMtoM(DHMObject $timespan):int
    {
       return 1440*$timespan->days + 60*$timespan->hours + $timespan->minutes;
    }

    public static function MtoDHM(int $minutes):DHMObject
    {
        $timespan = new DHMObject();
        $timespan->days = intdiv($minutes,1440);
        $minutes-= $timespan->days * 1440;
        $timespan->hours = intdiv($minutes,60);
        $minutes-= $timespan->hours * 60;
        $timespan->minutes = $minutes;
        return $timespan;
    }

    public static function DHMtoText(DHMObject $timespan):string
    {
        $res = '';


        if ($timespan->days>0)
            $res .= self::wordform($timespan->days,'день','дня','дней').' ';
        if ($timespan->hours>0)
            $res .= self::wordform($timespan->hours,'час','часа','часов').' ';
        if ($timespan->minutes>0)
            $res .= self::wordform($timespan->minutes,'минута','минуты','минут').' ';

        if ($res=='') $res = 'промежуток не задан';

        return $res;
    }

    public static function MtoText(int $minutes):string
    {
        return self::DHMtoText(self::MtoDHM($minutes));
    }



    private  static function  wordform($num, $form_for_1, $form_for_2, $form_for_5){
        $num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
        $num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
        if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
            return ''.$num.' '.$form_for_5;
        if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
            return ''.$num.' '.$form_for_2;
        if ($num_x == 1) // иначе если оканчивается на 1
            return ''.$num.' '.$form_for_1;
        return ''.$num.' '.$form_for_5;
    }
}