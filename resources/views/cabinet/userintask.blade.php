@extends('layouts.app')

@section('content')
    <div id="app"></div>
@endsection


@section('script')
<script src="{{ mix('js/userintask.js', 'build') }}"></script>
@endsection
