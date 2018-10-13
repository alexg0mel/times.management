<?php

namespace App\UseCases\Timelines\Statuses;


class Planing implements StatusInterface
{
   public static function getId(): int
   {
       return 4;
   }

   public static function getName(): string
   {
       return 'Planing';
   }
}