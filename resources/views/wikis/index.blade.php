@extends('layouts.master')

@section('title')
{!! trans('wikis.wikis') !!}
@if(isset($project->id))
    <a href="{{ route('projects.wikis.create', [$project->slug]) }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endif
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('wikis.wikis') !!}</li>
@endsection

@section('content')
<div class="box">

    <div class="box-body table-responsive no-padding">
        {!! $wikis->render() !!}

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>{!! trans('fields.id') !!}</th>
                    <th>{!! trans('fields.name') !!}</th>
                    <th>{!! trans('projects.project') !!}</th>
                    <th></th>
                </tr>
                @foreach($wikis as $wiki)
                    <tr>
                        <td>{{ $wiki->id }}</td>
                        <td>
                            <a href="{{ route('projects.wikis.show', [$wiki->project->slug, $wiki->slug]) }}">
                                {{ $wiki->title }}
                            </a>
                        </td>
                        <td>{{ $wiki->project->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('projects.wikis.edit', [$wiki->project->slug, $wiki->slug]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$wiki->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $wiki->title]),
                                'title' => trans('delete'),
                                'route' => ['projects.wikis.destroy', $wiki->project->slug, $wiki->slug]
                            ]) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $wikis->render() !!}
    </div>

</div>
@endsection
