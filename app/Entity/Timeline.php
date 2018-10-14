<?php

namespace App\Entity;

use App\UseCases\Timelines\Statuses\Drafting;
use App\UseCases\Timelines\Statuses\StatusInterface;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = ['start_time', 'end_time', 'status'];


    public static function new($start_time, $end_time): self
    {
        return static::create([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => Drafting::getName(),

        ]);
    }

}
