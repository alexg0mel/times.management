<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Group
 *
 * @property int $id
 * @property string $name_group
 * @property int $timeline_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Group whereNameGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Group whereTimelineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $table = 'task_groups';

    protected $fillable = ['name_group', 'timeline_id'];

}
