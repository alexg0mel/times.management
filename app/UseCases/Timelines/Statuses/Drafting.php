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

   public static function getNextStatuses(): array
   {
       return [(TimelinesStatuses::STATUS_WAIT)::getName(),(TimelinesStatuses::STATUS_PLANING)::getName(),];
   }

    public static function setStatus(TimelinesStatuses $timelineStatuses): void
    {
        $timelineStatuses->setDrafting();
    }
}