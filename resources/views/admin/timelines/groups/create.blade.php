@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')
    <h3>Группа задач для: <a href="{{ route('admin.timelines.show', $timeline) }}">{{ $timeline->name }}</a></h3>
    <form method="POST" action="{{ route('admin.timelines.groups.store', ['timeline' => $timeline]) }}">
        @csrf

        <div class="form-group">
            <label for="name_group" class="col-form-label">Наименование группы задач</label>
            <input id="name_group" class="form-control{{ $errors->has('name_group') ? ' is-invalid' : '' }}" name="name_group" value="{{ old('name_group') }}" required>
            @if ($errors->has('name_group'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name_group') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection