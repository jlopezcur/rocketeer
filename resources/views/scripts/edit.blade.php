@extends('layouts.master')

@section('title')
{{ trans('scripts.scripts') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('scripts.index') }}">{{ trans('scripts.scripts') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($script, ['method' => 'PATCH', 'route' => ['scripts.update', $script->id]]) !!}

    @include('scripts.form.master')

{!! Form::close() !!}
@endsection
