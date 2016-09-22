@extends('layouts.master')

@section('title')
{{ trans('labels.labels') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li><a href="{{ route('projects.labels.index', [$project->slug]) }}"> {{ trans('labels.labels') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($label, ['route' => ['projects.labels.store', $project->slug]]) !!}
<div class="panel">
    <div class="panel-body">
        @include('labels.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
    </div>
</div>
{!! Form::close() !!}
@endsection
