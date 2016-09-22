<table class="table table-hover table-striped table-condensed">
    <thead>
        <tr>
            <th>{!! trans('users.user') !!}</th>
            <th>{!! trans('vaults.vault') !!}</th>
            <th>{!! trans('scripts.script') !!}</th>
            <th>{!! trans('admin.start') !!}</th>
            <th>{!! trans('admin.end') !!}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($server->runtimes as $runtime)
            <tr>
                <td>
                    <a href="{{ route('users.show', [$runtime->user->id]) }}">
                        {{ $runtime->user->full_name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('vaults.show', [$runtime->vault->id]) }}">
                        {{ $runtime->vault->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('scripts.show', [$runtime->script->id]) }}">
                        {{ $runtime->script->name }}
                    </a>
                </td>
                <td>
                    {{ $runtime->created_at->diffForHumans() }}
                </td>
                <td>
                    {{ $runtime->end->diffForHumans() }}
                </td>
                <td>
                    {!! make_dialog([
                        'id' => 'showRuntime'.$runtime->id,
                        'link_content' => '<i class="fa fa-file-text"></i>',
                        'link_class' => 'btn btn-success btn-xs',
                        'content' => '<pre>' . $runtime->output . '</pre>',
                        'title' => trans('runtimes.output')
                    ]) !!}
                    <a href="{{ route('runtimes.run', [$runtime->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-play"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('servers.parts.runtimes.form')
