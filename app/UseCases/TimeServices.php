<?php

namespace App\UseCases;

use App\Entity\Task;
use App\Entity\Time;
use App\Entity\User;
use App\UseCases\Timelines\Statuses\Active;
use Carbon\Carbon;

class TimeServices
{
    /** @var User $user */
    private  $user;

    public static function New(User $user)
    {
        return (new self())->withUser($user);
    }

    private function __construct()
    {
        //
    }

    public function withUser(User $user): self
    {
        $this->user = $user;
        return clone $this;
    }


    public function getTasks():array
    {
        $tasks= Task::whereHas(
            'groups', function ($q){
            $q->whereHas('timeline', function($q){
                $q->where(['status' =>Active::getName()]);
            });
        })->whereHas('users', function ($q) {
            $q->where(['id' => $this->user->id]);
        })->with('project')->with('groups')->get();

        $groups = [];
        $projects = [];

        foreach ($tasks as $task){
            foreach ($task->groups as $group){
                $groups=array_add($groups,$group->id, $group->name_group);
            }
            $projects = array_add($projects,$task->project->id,$task->project->name_project);
        }

        $result = [];
        foreach ($groups as $group_id=>$name_group){
            $group_item = new \stdClass();
            $group_item->group_id = $group_id;
            $group_item->name_group = $name_group;
            $group_item->projects = [];
            foreach ($projects as $project_id=>$name_project){
                $project_item = new \stdClass();
                $project_item->project_id = $project_id;
                $project_item->name_project = $name_project;
                $project_item->tasks = [];
                foreach ($tasks as $task){
                    if ($task->project_id == $project_id){
                        foreach ($task->groups as $group){
                            if ($group->id == $group_id) {
                                $task_item = new \stdClass();
                                $task_item->task_id = $task->id;
                                $task_item->name_task = $task->name_task;
                                $project_item->tasks[] = $task_item;
                            }
                        }
                    }
                }
                if(count($project_item->tasks) >0)
                    $group_item->projects[] = $project_item;
            }
            $result[] = $group_item;
        }

        return $result;
    }

    public function startTime(int $group_id, int $task_id): Time
    {
        return Time::create([
            'group_id' =>$group_id,
            'task_id' =>$task_id,
            'user_id' =>$this->user->id,
            'start_time' => Carbon::now(),
            'step_opis' => '',
        ]);
    }


    public function setOpis(string $step_opis): void
    {
        $time = Time::whereUserId($this->user->id)->whereNull('end_time')->first();
        $time->step_opis = $step_opis;
        $time->save();
    }

    /**
     * @return Time |null
     */
    public function getTime()
    {
        return $time = Time::whereUserId($this->user->id)->whereNull('end_time')->with('task')-> first();
    }

    public function stopTime(): void
    {
        $time = Time::whereUserId($this->user->id)->whereNull('end_time')->first();
        $time->end_time = Carbon::now();
        $time->fact_time = $time->end_time->diffInSeconds($time->start_time);
        $time->save();
    }
}