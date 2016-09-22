@extends('layouts.master')

@section('title')
{{ trans('deployments.deployments') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('deployments.index') }}">{{ trans('deployments.deployments') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($deployment, ['method' => 'PATCH', 'route' => ['deployments.update', $deployment->id]]) !!}

        @include('deployments.parts.form')

        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
