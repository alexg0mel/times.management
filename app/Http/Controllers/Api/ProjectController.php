<?php

namespace App\Http\Controllers\Api;

use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Users\ActiveTaskServices;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $activeTaskService = new ActiveTaskServices($user);
        return $activeTaskService->getProjects();

    }

    public function tasks(Request $request, int $project)
    {
        $user = $request->user();
        $activeTaskService = new ActiveTaskServices($user);
        return $activeTaskService->getTasks($project);
    }

    public function link(Request $request, int $project, int $task)
    {
        $user = $request->user();
        $activeTaskService = new ActiveTaskServices($user);
        $activeTaskService->link($task);
        return 'linked';
    }

    public function unlink(Request $request, int $project, int $task)
    {
        $user = $request->user();
        $activeTaskService = new ActiveTaskServices($user);
        $activeTaskService->unlink($task);
        return 'unlinked';
    }
}
