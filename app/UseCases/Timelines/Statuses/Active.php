<?php

namespace App\UseCases\Timelines\Statuses;


class Active implements StatusInterface
{
   public static function getId(): int
   {
       return 2;
   }

   public static function getName(): string
   {
       return 'Active';
   }

}