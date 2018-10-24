<?php

namespace App\UseCases;

use App\Entity\Project;
use App\Entity\Task;

class GroupServices
{

    public function getProjects($group_id)
    {
        $activeProjectWithFreeTask= Project::whereHas('tasks', function ($q) {
            $q->where(['used'=>false]);
        })->active();

        $projectInGroup = Project::whereHas('tasks', function ($q) use ($group_id) {
            $q->whereHas('groups', function ($q) use ($group_id) {
                $q->where(['id'=>$group_id]);
            });
        });

        return $activeProjectWithFreeTask->union($projectInGroup)->orderBy('id')->get();

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