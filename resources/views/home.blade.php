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
                    <div class="links container pt-4">
                        <p class="btn btn-secondary"> ссылки для демо</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-success"><a href=" {{ route('admin.home') }}">admin zone</a> Здесь настраиваются проекты/задачи и таймлайны</li>
                            <li class="list-group-item list-group-item-success"><a href="{{ route('cabinet.task.active') }}">my tasks</a> Личная зона - привязка проектов к пользователю</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')

    <script src="{{ mix('js/step.js', 'build') }}"></script>

@endsection