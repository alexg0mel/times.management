<table class="table table-bordered table-striped pointer">
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
        <tr onclick="window.location.href='{{ route("admin.timelines.show", $timeline) }}'; return false">
            <td>{{ $timeline->created_at->format('d-m-Y h:m:s') }}</td>
            <td>{{ $timeline->updated_at->format('d-m-Y h:m:s') }}</td>
            <td>{{ $timeline->start_time->format('d-m-Y') }}</td>
            <td>{{ $timeline->end_time->format('d-m-Y') }}</td>
            <td>{{ $timeline->status }}</td>

        </tr>
    @endforeach

    </tbody>
    {{ $timelines->links() }}
</table>