@extends('layouts.app')

@section('content')
    <div id="app">
    </div>
@endsection


@section('script')
<script>
    Window.Laravel = {!! $token !!}  </script>
<script src="{{ mix('js/userreport.js', 'build') }}"></script>
@endsection
