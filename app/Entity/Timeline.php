<?php

namespace App\Entity;

use App\UseCases\Timelines\Statuses\Drafting;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = ['start_time', 'end_time', 'status'];

    protected $dates = ['start_time', 'end_time'];


    public static function new($start_time, $end_time): self
    {
        return static::create([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => Drafting::getName(),

        ]);
    }


}
