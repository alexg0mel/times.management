<?php


namespace App\UseCases\Timelines\Statuses;


interface StatusInterface
{
    public static function getId():int;
    public static function getName():string;
    public static function getNextStatuses():array ;
    public static function setStatus(TimelinesStatuses $timelineStatuses):void;
}