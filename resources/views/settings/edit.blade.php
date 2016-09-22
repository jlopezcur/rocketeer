@extends('layouts.master')

@section('title')
{{ trans('settings.settings') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{{ trans('settings.settings') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::open(['route' => ['settings.update']]) !!}

        @include('settings.parts.form')

        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
