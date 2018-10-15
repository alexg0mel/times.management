<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Group;
use App\Entity\Timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{


    public function create(Timeline $timeline)
    {
        return view('admin.timelines.groups.create', ['timeline' => $timeline]);
    }


    public function store(Request $request, Timeline $timeline)
    {
        $this->validate($request, [
            'name_group' => 'required|string|max:255',
        ]);

        $group = Group::create([
            'name_group' => $request['name_group'],
            'timeline_id' => $timeline->id
        ]);

        return redirect()->route('admin.timelines.groups.show', ['timeline' => $timeline, 'group' => $group]);
    }


    public function show(Timeline $timeline, Group $group)
    {
        return view('admin.timelines.groups.show', ['timeline' => $timeline, 'group' => $group]);
    }


    public function edit(Timeline $timeline, Group $group)
    {
        return view('admin.timelines.groups.edit', ['timeline' => $timeline, 'group' => $group]);
    }


    public function update(Request $request, Timeline $timeline, Group $group)
    {
        $this->validate($request, [
            'name_group' => 'required|string|max:255',
        ]);

        $group->update([
            'name_group' => $request['name_group'],
        ]);

        return redirect()->route('admin.timelines.groups.show', ['timeline' => $timeline, 'group' => $group]);
    }


    public function destroy(Timeline $timeline, Group $group)
    {
        $group->delete();

        return redirect()->route('admin.timelines.show', $timeline->id);
    }
}
