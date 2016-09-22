@extends('layouts.master')

@section('title')
{!! trans('scripts.scripts') !!}
<a href="{{ route('scripts.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('scripts.scripts') !!}</li>
@endsection

@section('content')
<div class="box">
    <div class="box-body table-responsive no-padding">
        {!! $scripts->render() !!}

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>{!! trans('fields.id') !!}</th>
                    <th>{!! trans('fields.name') !!}</th>
                    <th>{!! trans('projects.project') !!}</th>
                    <th>{!! trans('servers.server') !!}</th>
                    <th></th>
                </tr>
                @foreach($scripts as $script)
                    <tr>
                        <td>{{ $script->id }}</td>
                        <td>
                            <a href="{{ route('scripts.edit', [$script->id]) }}">
                                {{ $script->name }}
                            </a>
                        </td>
                        <td>
                            @if(isset($script->project->id))
                                {{ $script->project->name }}
                            @else
                                {!! trans('fields.none') !!}
                            @endif
                        </td>
                        <td>-</td>
                        <td class="text-right">
                            <a href="{{ route('scripts.edit', [$script->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$script->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $script->company]),
                                'title' => trans('delete'),
                                'route' => ['scripts.destroy', $script->id]
                            ]) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $scripts->render() !!}
    </div>

</div>
@endsection
