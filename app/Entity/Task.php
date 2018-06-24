<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Entity
 *
 * @property int $id
 * @property string $name_task
 * @property int $project_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Project   $project
 */
class Task extends Model
{

    protected $fillable = ['name_task', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
