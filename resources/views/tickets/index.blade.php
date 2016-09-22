@extends('layouts.master')

@section('title')
Tickets
@endsection

@section('breadcrumb')
<li class="active"><a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i> {{ trans('tickets.tickets') }}</a></li>
@endsection

@section('actions')
<a href="{{ route('tickets.create') }}" class="btn btn-primary">{{ trans('tickets.add_ticket') }}</a>
@endsection

@section('content')

    @include('tickets.parts._filters')
    @include('tickets.parts._list')

@endsection
