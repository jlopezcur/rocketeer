@extends('layouts.master')

@section('title')
{{ trans('tickets.edit') }}
@endsection

@section('breadcrumb')
<li><a href="{{ route('tickets.index') }}"><i class="fa fa-bug"></i> {{ trans('tickets.tickets') }}</a></li>
<li class="active">{{ trans('tickets.edit') }}</li>
@endsection

@section('content')
{!! Form::model($ticket, ['method' => 'PATCH', 'route' => ['tickets.update', $ticket->id]]) !!}

	@include('tickets.parts._form')

	<div class="clearfix separator"></div>

	{!! Form::submit(trans('tickets.edit'), ['class' => 'btn btn-primary']) !!}
	<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-default">{{ trans('tickets.back') }}</a>

{!! Form::close() !!}
@endsection
