<?php

namespace App\UseCases\Timelines\Statuses;


use App\Entity\Timeline;

class TimelinesStatuses
{
   public const STATUS_WAIT = Wait::class;         //1
   public const STATUS_ACTIVE = Active::class;     //2
   public const STATUS_COMPLETE = Complete::class; //3
   public const STATUS_PLANING = Planing::class;   //4
   public const STATUS_DRAFTING = Drafting::class; //5
    /**
     *   создание timeline как черновик (5)
     * (5) => (1) or (4) черновик
     * (1) => (4)  ожидание - долгосрочные задумки
     * (4) => (2)  запланировано - следующий активный срок
     * (2) => (3)  активный
     * (3)         выполнено
     *   сроки старт-стоп на стадии Активный и Выполнено - меняться не могут
     */


    /**
     * @var Timeline
     */
    private $timeline;


    public function __construct(Timeline $timeline)
   {

       $this->timeline = $timeline;
   }


    public function getTimelines(): Timeline
    {
       return $this->timeline;
    }

    public function setPlaning(): void
    {
        if ($this->timeline->status == (self::STATUS_ACTIVE)::getName())
            throw new \DomainException('Unable to change active status.');
        if ($this->timeline->status == (self::STATUS_COMPLETE)::getName())
            throw new \DomainException('Unable to change completed status.');
        $this->setStatus(self::STATUS_PLANING);

    }

    public function setComplete(): void
    {
        if ($this->timeline->status == (self::STATUS_ACTIVE)::getName()){
            $this->setStatus(self::STATUS_COMPLETE);
            return;
        }


        throw new \DomainException('Unable to complete inactive.');
    }

    public function setWait(): void
    {
        if ($this->timeline->status == (self::STATUS_DRAFTING)::getName()){
            $this->setStatus(self::STATUS_WAIT);
            return;
        }


        throw new \DomainException('Original status is not a draft.');
    }

    public function setActive():void
    {
        if ($this->timeline->status == (self::STATUS_PLANING)::getName()) {
            $this->setStatus(self::STATUS_ACTIVE);
            return;
        }


        throw new \DomainException('Original status is not a planned.');
    }

    public function setDrafting():void
    {
        $this->setStatus(self::STATUS_DRAFTING);
    }

    private function setStatus(string $status): void
    {
        if ($this->timeline->status == $status::getName())
            throw new \DomainException('This status is already set.');

        $this->timeline->status = $status::getName();
        $this->timeline->save();
    }

    public function getNextStatuses():array
    {
        return $this->getFullnameStatus($this->timeline->status)::getNextStatuses();
    }

    public function getFullnameStatus(string $status):string
    {
        return __NAMESPACE__.'\\'.$status;
    }


}