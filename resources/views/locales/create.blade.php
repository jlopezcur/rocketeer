@extends('layouts.master')

@section('title')
{{ trans('locales.locales') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('locales.index') }}"> {{ trans('locales.locales') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($locale, ['route' => ['locales.store']]) !!}
<div class="panel">
    <div class="panel-body">
        @include('locales.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection
