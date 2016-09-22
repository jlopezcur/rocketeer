{!! $tickets->appends(Request::except('page'))->render() !!}

<table class="table table-striped table-hover table-condensed">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Assigned to</th>
            <th>Resolved by</th>
            <th>Project</th>
            <th>Modified</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach($tickets as $ticket)
        <tr>
            <td>
                @if ($ticket->status == 'resolved')
                    <s>
                @endif
                {!! link_to_route('tickets.show', '#'.$ticket->id.': '.$ticket->title, [$ticket->id]) !!}</td>
                @if ($ticket->status == 'resolved')
                    </s>
                @endif
            <td>{{ ($ticket->status != '' ? $ticket->status : 'open') }}</td>
            <td><a href="{{ route('users.show', [$ticket->assignedTo()->first()->id]) }}">{!! avatar($ticket->assignedTo()->first()->email, 16) !!} {{ $ticket->assignedTo()->first()->name }}</a></td>
            <td>
                @if ($ticket->resolvedBy()->first() != null)
                    <a href="{{ route('users.show', [$ticket->resolvedBy()->first()->id]) }}">{!! avatar($ticket->resolvedBy()->first()->email, 16) !!} {{ $ticket->resolvedBy()->first()->name }}</a>
                @endif
            </td>
            <td>
                @if ($ticket->project()->first() != null)
                    <a href="{{ route('projects.show', ['project' => $ticket->project()->first()->slug]) }}">{{ $ticket->project()->first()->name }}</a>
                @endif
            </td>
            <td>{{ Date::parse($ticket->updated_at)->ago() }}</td>
            <td class="text-right">
                <a href="{{ route('tickets.show', [$ticket->id]) }}"><i class="fa fa-eye"></i></a>
                <a href="{{ route('tickets.edit', [$ticket->id]) }}"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $tickets->appends(Request::except('page'))->render() !!}
