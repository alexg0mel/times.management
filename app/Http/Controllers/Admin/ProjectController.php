<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function create(Request $request)
    {

        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_project' => 'required|string|max:255|unique:projects',
        ]);

        $project = Project::create([
            'name_project' => $request['name_project'],
        ]);

        return redirect()->route('admin.projects.show', $project);
    }

    public function show(Project $project)
    {
        $tasks = $project->tasks;

        return view('admin.projects.show', ['project' => $project, 'tasks' => $tasks,]);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name_project' => 'required|string|max:255|unique:projects',
        ]);

        $project->update([
            'name_project' => $request['name_project'],
        ]);

        return redirect()->route('admin.projects.show', $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
