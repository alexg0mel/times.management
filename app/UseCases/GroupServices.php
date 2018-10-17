<?php

namespace App\UseCases;

use App\Entity\Project;
use App\Entity\Task;

class GroupServices
{

    public function getProjects()
    {
        return Project::whereHas('tasks', function ($q) {
            $q->where(['used'=>false]);
        })->active()->orderBy('id')-> get(['id','name_project']);
    }

    public function getFreeTasks($project_id)
    {
        return Task::whereUsed(false)->where(['project_id'=>$project_id])->orderBy('name_task')->get(['id', 'name_task']);
    }

    public function getGroupTasks($project_id, $group_id)
    {
        return Task::whereProjectId($project_id)->whereHas('groups', function ($q)  use ($group_id){
            $q->where(['id'=> $group_id]);
        })->orderBy('name_task')->get(['id', 'name_task']);
    }

    public function linkTaskToGroup($group_id, $task_id)
    {
        $task= Task::find($task_id);
        $task->used=true;
        $task->save();
        $task->groups()->attach($group_id);
    }


    public function unlinkTaskToGroup($group_id, $task_id)
    {
        $task= Task::find($task_id);
        $task->used=false;
        $task->save();
        $task->groups()->detach($group_id);
    }
}