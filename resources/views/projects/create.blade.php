@extends('layouts.master')

@section('title')
{{ trans('projects.projects') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.index') }}"> {{ trans('projects.projects') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($project, ['route' => ['projects.store']]) !!}
<div class="panel">
    <div class="panel-body">
        @include('projects.form.master')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection
