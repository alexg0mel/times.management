<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Project;
use App\Entity\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function create(Project $project)
    {

        return view('admin.projects.tasks.create', ['project' => $project]);
    }

    public function store(Request $request, Project $project)
    {
        $this->validate($request, [
            'name_task' => 'required|string|max:255|unique:tasks,name_task,NULL,NULL,project_id,'.$project->id,
        ]);

        $task = Task::create([
            'name_task' => $request['name_task'],
            'project_id' => $project->id
        ]);

        return redirect()->route('admin.projects.tasks.show', ['project' => $project, 'task' => $task]);
    }

    public function show(Project $project, Task $task)
    {

        return view('admin.projects.tasks.show', ['project' => $project, 'task' => $task]);
    }

    public function edit(Project $project, Task $task)
    {
        return view('admin.projects.tasks.edit', ['project' => $project, 'task' => $task]);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $this->validate($request, [
            'name_task' => 'required|string|max:255|unique:tasks,name_task,'.$task->id.',id,project_id,'.$project->id,
        ]);

        $task->update([
            'name_task' => $request['name_task'],
            'plan_time' => $request['plan_time'],
        ]);

        return redirect()->route('admin.projects.tasks.show', ['project' => $project, 'tack' => $task]);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('admin.projects.show', $project->id);
    }
}
