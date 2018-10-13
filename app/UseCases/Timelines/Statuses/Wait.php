<?php

namespace App\UseCases\Timelines\Statuses;


class Wait implements StatusInterface
{
   public static function getId(): int
   {
       return 1;
   }

   public static function getName(): string
   {
       return 'Wait';
   }
}