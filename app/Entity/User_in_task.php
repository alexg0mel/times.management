<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User_in_task
 *
 * @package App\Entity
 * @property int $task_id
 * @property int $user_id
 * @property Task $task
 * @property User $user
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User_in_task whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User_in_task whereUserId($value)
 */
class User_in_task extends Model
{

    protected  $table = 'user_in_task';

    protected $fillable = ['task_id', 'user_id'];


    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
