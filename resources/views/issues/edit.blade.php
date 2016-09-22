@extends('layouts.master')

@section('title')
{{ trans('issues.issues') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li><a href="{{ route('projects.issues.index', [$project->slug]) }}">{{ trans('issues.issues') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($issue, ['method' => 'PATCH', 'route' => ['projects.issues.update', $project->slug, $issue->id]]) !!}
<div class="panel">
    <div class="panel-body">
        @include('issues.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
		<a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
    </div>
</div>
{!! Form::close() !!}
@endsection
