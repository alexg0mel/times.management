<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($projects as $project)
        <tr>
            <td><a href="{{ route('admin.projects.show', $project) }}">{{ $project->name_project }}</a></td>
        </tr>
    @endforeach

    </tbody>
    {{ $projects->links() }}
</table>