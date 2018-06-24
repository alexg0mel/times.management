@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')
    <h3>Задача проекта: <a href="{{ route('admin.projects.show', $project) }}">{{ $project->name_project }}</a></h3>
    <form method="POST" action="{{ route('admin.projects.tasks.store', ['projects' => $project]) }}">
        @csrf

        <div class="form-group">
            <label for="name_task" class="col-form-label">Наименование задачи</label>
            <input id="name_task" class="form-control{{ $errors->has('name_task') ? ' is-invalid' : '' }}" name="name_task" value="{{ old('name_task') }}" required>
            @if ($errors->has('name_task'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name_task') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection