@extends('layouts.app')

@section('content')
    <div id="app">
        <active-task-component></active-task-component>
    </div>
@endsection


@section('script')
<script>
    Window.Laravel = {!! $token !!}  </script>
<script src="{{ mix('js/userintask2.js', 'build') }}"></script>
@endsection
