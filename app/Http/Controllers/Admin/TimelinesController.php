<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Timeline;
use App\UseCases\Timelines\Statuses\TimelinesStatuses;
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
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $timeline = Timeline::new($request['start_time'], $request['end_time']);

        return redirect()->route('admin.timelines.show', $timeline);
    }

    public function show(Timeline $timeline)
    {
        $groups = $timeline->groups;
        $timelineStatuses = new TimelinesStatuses($timeline);
        return view('admin.timelines.show', ['timeline' => $timeline,
                                                    'statuses' => $timelineStatuses->getNextStatuses(),
                                                    'groups' => $groups,
                                                ]);
    }

    public function edit(Timeline $timeline)
    {
        return view('admin.timelines.edit', ['timeline' => $timeline]);
    }

    public function update(Request $request, Timeline $timeline)
    {
        $this->validate($request, [
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $timeline->update([
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
        ]);

        return redirect()->route('admin.timelines.show', $timeline);
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return redirect()->route('admin.timelines.index');
    }

    public function status(Timeline $timeline, string $status)
    {
        $timelineStatuses = new TimelinesStatuses($timeline);
        $timelineStatuses->getFullnameStatus($status)::setStatus($timelineStatuses);
        return redirect()->route('admin.timelines.show', $timeline);
    }
}
