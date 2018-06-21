@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')

    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name_project" class="col-form-label">Наименование</label>
            <input id="name_project" class="form-control{{ $errors->has('name_project') ? ' is-invalid' : '' }}" name="name_project" value="{{ old('name_project', $project->name_project) }}" required>
            @if ($errors->has('name_project'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name_project') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection