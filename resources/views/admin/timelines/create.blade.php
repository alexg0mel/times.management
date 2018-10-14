@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')

    <form method="POST" action="{{ route('admin.timelines.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Наименование проекта</label>
            <input id="name" class="form-control{{ $errors->has('name_project') ? ' is-invalid' : '' }}" name="name_project" value="{{ old('name_project') }}" required>
            @if ($errors->has('name_project'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name_project') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection