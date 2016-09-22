@extends('layouts.master')

@section('title')
{{ trans('deployments.deployments') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('deployments.index') }}"> {{ trans('deployments.deployments') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($deployment, ['route' => ['deployments.store']]) !!}

        @include('deployments.parts.form')

        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
