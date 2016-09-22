@extends('layouts.master')

@section('title')
{{ trans('scripts.scripts') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('scripts.index') }}"> {{ trans('scripts.scripts') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($script, ['route' => ['scripts.store']]) !!}

    @include('scripts.form.master')

{!! Form::close() !!}
@endsection
