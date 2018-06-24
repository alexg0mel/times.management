<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Entity
 *
 * @property int $id
 * @property string $name_project
 *
 * @property Task[] $tasks
 */
class Project extends Model
{
    protected $fillable = ['name_project'];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

}
