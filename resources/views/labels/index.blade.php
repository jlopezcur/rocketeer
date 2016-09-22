@extends('layouts.master')

@section('title')
{!! trans('labels.labels') !!}
<a href="{{ route('projects.labels.create', [$project->slug]) }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li class="active">{!! trans('labels.labels') !!}</li>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{!! trans('labels.labels') !!}</h3>
    </div>

    <div class="box-body table-responsive no-padding">
        {!! $labels->render() !!}

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>{{ $labels->count() }} labels</th>
                    <th></th>
                    <th class="text-right">Sort</th>
                </tr>
                @foreach($labels as $label)
                    <tr>
                        <td>
                            <span class="label" style="background: {{ $label->color }}; font-size: 18px;">
                                <i class="fa fa-tag fa-fw"></i> {{ $label->name }}
                            </span>
                        </td>
                        <td>
                            0 open issues
                        </td>
                        <td class="text-right">
                            <a href="{{ route('projects.labels.edit', [$project->slug, $label->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$label->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $label->company]),
                                'title' => trans('delete'),
                                'route' => ['projects.labels.destroy', $project->slug, $label->id]
                            ]) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $labels->render() !!}
    </div>

</div>
@endsection
