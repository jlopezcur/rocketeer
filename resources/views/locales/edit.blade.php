@extends('layouts.master')

@section('title')
{{ trans('locales.locale') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('locales.index') }}">{{ trans('locales.locale') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($locale, ['method' => 'PATCH', 'route' => ['locales.update', $locale->id]]) !!}
<div class="panel">
    <div class="panel-body">
        @include('locales.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection
