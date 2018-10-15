@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.timelines.groups.edit', ['timeline' =>$timeline, 'group' => $group]) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.timelines.groups.update', ['timeline' =>$timeline, 'group' => $group]) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <h3>Группа задач для: <a href="{{ route('admin.timelines.show', $timeline) }}">{{ $timeline->name }}</a></h3>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $group->id }}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{ $group->name_group }}</td>
        </tr>
        </tbody>
    </table>


@endsection