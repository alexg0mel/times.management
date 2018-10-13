<?php

namespace App\UseCases\Timelines\Statuses;


class Drafting implements StatusInterface
{
   public static function getId(): int
   {
       return 5;
   }

   public static function getName(): string
   {
       return 'Drafting';
   }
}