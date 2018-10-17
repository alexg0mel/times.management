<?php

namespace App\Http\Controllers\Api;

use App\UseCases\GroupServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * @var GroupServices
     */
    private $groupServices;

    public function projects()
    {
        return $this->groupServices->getProjects();

    }

    public function freeTasks($project)
    {
      return $this->groupServices->getFreeTasks($project);
    }

    public function groupTasks($project,$group)
    {
        return $this->groupServices->getGroupTasks($project,$group);
    }


    public function linkTasks($group, $task)
    {
        return $this->groupServices->linkTaskToGroup($group, $task);
    }

    public function unlinkTasks($group, $task)
    {
        return $this->groupServices->unlinkTaskToGroup($group, $task);
    }

    public function __construct(GroupServices $groupServices)
    {
        $this->groupServices = $groupServices;
    }

}
