<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Entity\Time
 *
 * @property int $id
 * @property int $group_id
 * @property int $task_id
 * @property int $user_id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int $fact_time
 * @property string $step_opis
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereFactTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereStepOpis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Time whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Entity\Task $task
 */
class Time extends Model
{
    protected $fillable = ['group_id', 'task_id', 'user_id', 'start_time','step_opis'];

    public $timestamps = false;


    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
