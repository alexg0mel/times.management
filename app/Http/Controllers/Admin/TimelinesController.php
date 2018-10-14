<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimelinesController extends Controller
{
    public function index()
    {
        $timelines = Timeline::orderByDesc('id')->paginate(10);

        return view('admin.timelines.index', ['timelines' => $timelines]);
    }

    public function create(Request $request)
    {

        return view('admin.timelines.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_project' => 'required|string|max:255|unique:projects',
        ]);

        $timeline = Timeline::create([
            'name_project' => $request['name_project'],
        ]);

        return redirect()->route('admin.timelines.show', $timeline);
    }

    public function show(Timeline $timeline)
    {

        return view('admin.timelines.show', ['timelines' => $timeline,]);
    }

    public function edit(Timeline $timeline)
    {
        return view('admin.timelines.edit', ['timelina' => $timeline]);
    }

    public function update(Request $request, Timeline $timeline)
    {
        $this->validate($request, [
            'name_project' => 'required|string|max:255|unique:projects',
        ]);

        $timeline->update([
            'name_project' => $request['name_project'],
        ]);

        return redirect()->route('admin.timelines.show', $timeline);
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return redirect()->route('admin.timelines.index');
    }
}
