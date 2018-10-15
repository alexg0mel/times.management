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

   public static function getNextStatuses(): array
   {
       return [(TimelinesStatuses::STATUS_PLANING)::getName(),];
   }

    public static function setStatus(TimelinesStatuses $timelineStatuses): void
    {
        $timelineStatuses->setWait();
    }
}