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

@endsection