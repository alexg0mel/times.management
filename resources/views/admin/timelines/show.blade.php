@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.timelines.edit', $timeline) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.timelines.destroy', $timeline) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
        @foreach($statuses as $status)

            <form method="POST" action="{{ route('admin.timelines.status', [$timeline, $status]) }}" class="mr-1">
                @csrf
                @method('PUT')
                <button class="btn btn-dark">{{ $status }}</button>
            </form>
        @endforeach

    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $timeline->id }}</td>
        </tr>
        <tr>
            <th>Начало</th><td>{{ $timeline->start_time->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Окончание</th><td>{{ $timeline->end_time->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Статус</th><td>{{ $timeline->status }}</td>
        </tr>
        </tbody>
    </table>

    <p><a href="{{ route('admin.timelines.groups.create', $timeline) }}" class="btn btn-success">Добавить группу задач</a></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Группы задач</th>
        </tr>
        </thead>
        <tbody>


        @forelse ($groups as $group)
            <tr>
                <td>
                    <a href="{{ route('admin.timelines.groups.show', [$timeline, $group]) }}">{{ $group->name_group }}</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Отсутствуют...</td></tr>
        @endforelse

        </tbody>
    </table>



@endsection