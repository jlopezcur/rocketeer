@extends('layouts.master')

@section('title')
{{ trans('vaults.vaults') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('vaults.index') }}">{{ trans('vaults.vaults') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
{!! Form::model($vault, ['route' => ['vaults.store']]) !!}
{!! Form::hidden('parent_id', Request::get('parent_id')) !!}
<div class="panel">
    <div class="panel-body">
		@include('vaults.form.master')
	</div>
	<div class="panel-footer">
		{!! Form::submit(trans('admin.create'), ['class' => 'btn btn-primary']) !!}
		<a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
	</div>
</div>
{!! Form::close() !!}
@endsection
