<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Главная</a></li>
    <li class="nav-item"><a class="nav-link{{ $page === 'projects' ? ' active' : '' }}" href="{{ route('admin.projects.index') }}">Проекты</a></li>
    <li class="nav-item"><a class="nav-link{{ $page === 'timelines' ? ' active' : '' }}" href="{{ route('admin.timelines.index') }}">Сроки разработки</a></li>
</ul>