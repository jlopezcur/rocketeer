@extends('layouts.master')

@section('title')
{!! trans('projects.projects') !!}
<a href="{{ route('projects.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('projects.projects') !!}</li>
@endsection

@section('content')

{!! $projects->render() !!}

@foreach($projects->chunk(4) as $chunk)

    <div class="row">
        @foreach($chunk as $project)

            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="box box-widget widget-user-2">

                    <div class="widget-user-header bg-blue">
                        <a href="{{ route('projects.show', [$project->slug]) }}">
                            <div class="widget-user-image">
                                @if (!empty($project->image))
                                    <img class="img-circle" src="{{ Croppa::url('thumbs' . $project->image, 128, 128, array('resize')) }}" alt="{{ $project->name }}" />
                                @else
                                    <span class="fa-stack fa-2x fa-pull-left">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-briefcase fa-stack-1x text-blue"></i>
                                    </span>
                                @endif
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{ $project->name }}</h3>
                        </a>
                        <a href="{{ route('users.show', [$project->user->id]) }}">
                            <h5 class="widget-user-desc">{{ $project->user->full_name }}</h5>
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="pull-right text-right">
                            <a href="{{ route('projects.edit', [$project->slug]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$project->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $project->name]),
                                'title' => trans('delete'),
                                'route' => ['projects.destroy', $project->slug]
                            ]) !!}
                        </div>

                        <a href="{{ route('deployments.index', ['project_id' => $project->id]) }}">
                            <span class="badge bg-blue">
                                {!! trans('deployments.deployments') !!} {{ $project->deployments->count() }}
                            </span>
                        </a>
                        &nbsp;
                        @if(($counter = $project->issues()->where('status', 'open')->count()) > 0)
                            <a href="{{ route('projects.issues.index', [$project->slug]) }}">
                                <span class="badge bg-blue">
                                    <i class="fa fa-bug"></i>
                                    {{ $counter }}
                                </span>
                            </a>
                        @else
                            <a href="{{ route('projects.issues.create', [$project->slug]) }}">
                                <span class="badge bg-blue">
                                    <i class="fa fa-bug"></i>
                                    {!! trans('admin.create') !!}
                                </span>
                            </a>
                        @endif
                        &nbsp;
                        <a href="{{ route('projects.wikis.index', [$project->slug]) }}">
                            <span class="badge bg-blue">
                                <i class="fa fa-file-text"></i>
                                {{ $project->wikis->count() }}
                            </span>
                        </a>
                    </div>
                </div>

            </div>

        @endforeach

    </div>

@endforeach

{!! $projects->render() !!}

@endsection
