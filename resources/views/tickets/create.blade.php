@extends('layouts.master')

@section('title')
{{ trans('tickets.create') }}
@endsection

@section('breadcrumb')
<li><a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i> {{ trans('tickets.tickets') }}</a></li>
<li class="active">{{ trans('tickets.create') }}</li>
@endsection

@section('content')
{!! Form::model($ticket, ['route' => ['tickets.store']]) !!}

	@include('tickets.parts._form')

	<div class="clearfix separator"></div>

	{!! Form::submit(trans('tickets.add_vault'), ['class' => 'btn btn-primary']) !!}
	<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-default">Back</a>

{!! Form::close() !!}
@endsection
