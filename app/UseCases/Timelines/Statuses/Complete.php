<?php

namespace App\UseCases\Timelines\Statuses;


class Complete implements StatusInterface
{
   public static function getId(): int
   {
       return 3;
   }

   public static function getName(): string
   {
       return 'Complete';
   }

   public static function getNextStatuses(): array
   {
       return [];
   }

    public static function setStatus(TimelinesStatuses $timelineStatuses): void
    {
        $timelineStatuses->setComplete();
    }
}