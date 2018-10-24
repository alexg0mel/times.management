@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div id="app">
                        <step token="{{ $token }}"></step>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')

    <script src="{{ mix('js/step.js', 'build') }}"></script>

@endsection