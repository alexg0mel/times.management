@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')

    <form method="POST" action="{{ route('admin.timelines.update', $timeline) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="start_time" class="col-form-label">Начало периода</label>
            <input type="date" id="start_time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" value="{{ old('start_time', $timeline->start_time->format('Y-m-d')) }}" required>
            @if ($errors->has('start_time'))
                <span class="invalid-feedback"><strong>{{ $errors->first('start_time') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="end_time" class="col-form-label">Конец периода</label>
            <input type="date" id="end_time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" value="{{ old('end_time', $timeline->end_time->format('Y-m-d')) }}" required>
            @if ($errors->has('start_time'))
                <span class="invalid-feedback"><strong>{{ $errors->first('end_time') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection