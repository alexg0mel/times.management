@extends('layouts.app')

@section('content')
    @include('admin.timelines._nav')

    <p><a href="{{ route('admin.timelines.create') }}" class="btn btn-success">Добавить срок разработки</a></p>
    @include('admin.timelines._list', ['timelines' => $timelines])
@endsection