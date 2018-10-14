<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Создан</th>
        <th>Изменен</th>
        <th>Начало</th>
        <th>Окончание</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($timelines as $timeline)
        <tr onclick="window.location.href='{{ route(`admin.timelines.show`, $timeline) }}'; return false">
            <td>{{ $timeline->created_at }}</td>
            <td>{{ $timeline->updated_at }}</td>
            <td>{{ $timeline->start_tine }}</td>
            <td>{{ $timeline->creted_at }}</td>
            <td>{{ $timeline->creted_at }}</td>

        </tr>
    @endforeach

    </tbody>
    {{ $timelines->links() }}
</table>