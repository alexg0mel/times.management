<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


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
 */

class Task extends Model
{

    protected $fillable = ['name_task', 'project_id'];

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
        return $this->belongsToMany(Tag::class,'task_in_tag', 'task_id', 'taag_id');
    }

}
