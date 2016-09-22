@extends('layouts.master')

@section('title')
{{ trans('servers.servers') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('servers.index') }}"> {{ trans('servers.servers') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($server, ['route' => ['servers.store']]) !!}

        @include('servers.parts.form')

        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
