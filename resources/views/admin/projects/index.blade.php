@extends('layouts.app')

@section('content')
    @include('admin.projects._nav')

    <p><a href="{{ route('admin.projects.create') }}" class="btn btn-success">Добавить проект</a></p>
    @include('admin.projects._list', ['projects' => $projects])
@endsection