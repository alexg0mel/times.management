@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $project->id }}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{ $project->name_project }}</td>
        </tr>
        </tbody>
    </table>
    <p><a href="{{ route('admin.projects.tasks.create', $project) }}" class="btn btn-success">Добавить задачу</a></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Задачи</th>
        </tr>
        </thead>
        <tbody>


        @forelse ($tasks as $task)
            <tr>
                <td>
                    <a href="{{ route('admin.projects.tasks.show', [$project, $task]) }}">{{ $task->name_task }}</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Отсутствуют...</td></tr>
        @endforelse

        </tbody>
    </table>


@endsection