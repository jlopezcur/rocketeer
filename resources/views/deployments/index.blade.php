@extends('layouts.master')

@section('title')
{!! trans('deployments.deployments') !!}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('deployments.deployments') !!}</li>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{!! trans('deployments.deployments') !!}</h3>
    </div>

    <div class="box-body table-responsive no-padding">
        {!! $deployments->render() !!}

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>{!! trans('fields.id') !!}</th>
                    <th>{!! trans('fields.name') !!}</th>
                    <th>{!! trans('projects.project') !!}</th>
                    <th>{!! trans('servers.server') !!}</th>
                    <th></th>
                </tr>
                @foreach($deployments as $deployment)
                    <tr>
                        <td>{{ $deployment->id }}</td>
                        <td>
                            <a href="{{ route('deployments.edit', [$deployment->id]) }}">
                                {{ $deployment->name }}
                            </a>
                        </td>
                        <td>{{ $deployment->project->name }}</td>
                        <td>{{ $deployment->server->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('deployments.edit', [$deployment->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$deployment->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $deployment->company]),
                                'title' => trans('delete'),
                                'route' => ['deployments.destroy', $deployment->id]
                            ]) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $deployments->render() !!}
    </div>

    <div class="box-footer">
        <a href="{{ route('deployments.create') }}" class="btn btn-primary">{!! trans('admin.create') !!}</a>
    </div>

</div>
@endsection
