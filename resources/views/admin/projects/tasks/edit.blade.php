@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')

    <h3>Задача проекта: <a href="{{ route('admin.projects.show', $project) }}">{{ $project->name_project }}</a></h3>


    <form method="POST" action="{{ route('admin.projects.tasks.update', ['project' => $project, 'task' => $task]) }}" onsubmit="return submitForm(this);">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name_task" class="col-form-label">Наименование</label>
            <input id="name_task" class="form-control{{ $errors->has('name_task') ? ' is-invalid' : '' }}" name="name_task" value="{{ old('name_task', $task->name_task) }}" required>
            @if ($errors->has('name_task'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name_task') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="plan_time" class="col-form-label">Планируемое время</label>
            <div id="app">
                <input-time name="plan_time" value="{{ old('plan_time', $task->plan_time) }}"></input-time>
            </div>
        </div>


        <div class="form-group">
            <button type="submit" id="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        var enSubmit = false;

        $('#submit').on('click', function () {
            enSubmit = true
        });

        function submitForm(form)
        {
            return enSubmit
        }


    </script>
    <script src="{{ mix('js/inputtime.js', 'build') }}"></script>
@endsection