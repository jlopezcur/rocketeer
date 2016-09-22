@extends('layouts.master')

@section('title')
{{ trans('milestones.milestones') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li><a href="{{ route('projects.milestones.index', [$project->slug]) }}"> {{ trans('milestones.milestones') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($milestone, ['method' => 'PATCH', 'route' => ['projects.milestones.update', $project->id, $milestone->id]]) !!}
<div class="panel">
    <div class="panel-body">
		@include('milestones.parts.form')
	</div>
	<div class="panel-footer">
		{!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
		<a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
	</div>
</div>
{!! Form::close() !!}
@endsection
