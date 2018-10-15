<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Tag
 *
 * @property int $id
 * @property string $name_tag
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Tag whereNameTag($value)
 * @mixin \Eloquent
 * @property int $frequency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Tag whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Tag whereSlug($value)
 */
class Tag extends Model
{
    protected $fillable = ['name_tag', 'slug'];


}
