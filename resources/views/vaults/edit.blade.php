@extends('layouts.master')

@section('title')
{{ trans('vaults.vaults') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('vaults.index') }}">{{ trans('vaults.vaults') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($vault, ['method' => 'PATCH', 'route' => ['vaults.update', $vault->id]]) !!}
<div class="panel">
    <div class="panel-body">
		@include('vaults.form.master')
	</div>
	<div class="panel-footer">
		{!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
		<a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
	</div>
</div>
{!! Form::close() !!}
@endsection
