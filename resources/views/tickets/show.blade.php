@extends('layouts.master')

@section('title')
Show ticket
@endsection

@section('breadcrumb')
<li><a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i> {{ trans('tickets.tickets') }}</a></li>
<li class="active">{{ trans('tickets.show') }}</li>
@endsection

@section('actions')
<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-default">Back</a>
@endsection

@section('content')

    <h2>{{ $ticket->title }}</h2>

    Assigned To: <a href="{{ route('users.show', [$ticket->assignedTo()->first()->id]) }}">{!! avatar($ticket->assignedTo()->first()->email, 16) !!} {{ $ticket->assignedTo()->first()->name }}</a><br>
    @if (!empty($ticket->resolvedBy()->first()))
        Resolved By: <a href="{{ route('users.show', [$ticket->resolvedBy()->first()->id]) }}">{!! avatar($ticket->resolvedBy()->first()->email, 16) !!} {{ $ticket->resolvedBy()->first()->name }}</a><br>
    @endif

    Name: {{ $ticket->name }}<br>
    Name: {{ $ticket->description }}<br>

@endsection
