<?php
/**
 * Created by PhpStorm.
 * User: alexgomel
 * Date: 5.10.18
 * Time: 15.09
 */

namespace App\UseCases\Users;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;


class ActiveTaskServices
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function getProjects()
    {

       $userProjectsQuery = Project::whereHas('tasks', function ($qt) {
           $qt->whereHas('users', function ($qu) {
               $qu->where(['id' => $this->user->id]);
           });

       });
       $allActiveProjectQuery = Project::where(['active' => 1]);
        return  $userProjectsQuery->union($allActiveProjectQuery)->orderBy('id')-> get();
    }

    public function getTasks(int $project_id)
    {
       $res = [];
        $usertasks =  Task::whereHas('users', function ($q) {
            $q->where(['id' => $this->user->id]);
        })->where(['project_id' => $project_id])->pluck('id')->toArray();

        $alltasks = Task::where(['project_id' => $project_id])->get();
        foreach ($alltasks as $task){
            $item = new \stdClass();
            $item -> id = $task->id;
            $item -> name_task = $task->name_task;
            $item -> active = false;
            if(in_array($task->id, $usertasks))
                $item -> active = true;

            $res[] = $item;
        }

       return $res;
    }

    public function link($task_id): void
    {
        /** @var Task $task */
        $task = Task::find($task_id);
        $task->users()->attach($this->user->id);
    }

    public function unlink($task_id): void
    {
        /** @var Task $task */
        $task = Task::find($task_id);
        $task->users()->detach($this->user->id);
    }


}