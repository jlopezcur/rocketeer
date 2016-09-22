@extends('layouts.master')

@section('title')
{{ trans('servers.servers') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('servers.index') }}">{{ trans('servers.servers') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($server, ['method' => 'PATCH', 'route' => ['servers.update', $server->id]]) !!}

        @include('servers.parts.form')

        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
