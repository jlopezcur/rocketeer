<table class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>{!! trans('fields.name') !!}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($project->vaults as $vault)
        <tr>
            <td>
                <a href="{{ route('vaults.show', [$vault->id]) }}">{{ $vault->name }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
