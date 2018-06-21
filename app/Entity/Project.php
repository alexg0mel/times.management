<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Entity
 *
 * @property int $id
 * @property string $name_project
 */
class Project extends Model
{
    protected $fillable = ['name_project'];

    public $timestamps = false;

}
