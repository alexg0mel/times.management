<?php

namespace App\Entity;

use App\UseCases\Timelines\Statuses\Drafting;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Timeline
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Group[] $groups
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Timeline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $name
 */
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

    public function groups()
    {
        return $this->hasMany(Group::class, 'timeline_id', 'id');
    }

    public function getNameAttribute(): string
    {
        return 'Срок разработки с '.$this->start_time->format('d-m-Y')
            .' по '.$this->end_time->format('d-m-Y').', статус: '.$this->status;
    }


}
