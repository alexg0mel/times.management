<?php


namespace App\UseCases\Timelines\Statuses;


interface StatusInterface
{
    public static function getId():int;
    public static function getName():string;
}