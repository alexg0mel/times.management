<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @package App\Entity
 * @property int $id
 * @property string $name_project
 * @property boolean $active
 * @property Task[] $tasks
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Project whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Project whereNameProject($value)
 */
class Project extends Model
{
    protected $fillable = ['name_project'];

    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function toogleActive()
    {
        $this->active = !$this->active;
        $this->save();
    }

    public function activity() : string
    {
        return $this->active ? 'да':'нет';
    }

}
