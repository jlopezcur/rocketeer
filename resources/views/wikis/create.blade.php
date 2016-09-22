@extends('layouts.master')

@section('title')
{{ trans('wikis.wikis') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('wikis.index') }}"> {{ trans('wikis.wikis') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($wiki, ['route' => ['projects.wikis.store', $project->slug]]) !!}
{!! Form::hidden('slug', (Request::has('slug') ? Request::get('slug') : 'home')) !!}
<div class="panel">
    <div class="panel-body">
        @include('wikis.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection
