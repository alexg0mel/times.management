@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.projects.tasks.edit', ['project' =>$project, 'task' => $task]) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.projects.tasks.update', ['project' =>$project, 'task' => $task]) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <h3>Задача проекта: <a href="{{ route('admin.projects.show', $project) }}">{{ $project->name_project }}</a></h3>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{ $task->name_task }}</td>
        </tr>
        <tr>
            <th>TimeSpan</th><td>{{ \App\Helpers\DateTimeHelper::MtoText($task->plan_time) }}</td>
        </tr>
        </tbody>
    </table>


@endsection