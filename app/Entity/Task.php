<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Entity\Task
 *
 * @property int $id
 * @property string $name_task
 * @property int $project_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entity\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereNameTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Tag[] $tags
 * @property int $used
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task whereUsed($value)
 * @property int $plan_time
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Group[] $groups
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Task wherePlanTime($value)
 */

class Task extends Model
{

    protected $fillable = ['name_task', 'project_id', 'plan_time'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_in_task', 'task_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'task_in_tag', 'task_id', 'tag_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class,'task_in_group', 'task_id', 'group_id');
    }

    public function times()
    {
        return $this->hasMany(Time::class, 'task_id', 'id');
    }

    public function getFactTimeAttribute(): int
    {
        return  ($this->times()->sum('fact_time') / 60);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['fact_time'] = $this->fact_time;
        return $array;
    }

}
