@extends('layouts.master')

@section('title')
{{ $server->name }}
<small>{{ $server->host }} / {{ $server->ip }}</small>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('servers.index') }}">{{ trans('servers.servers') }}</a></li>
<li class="active">{{ trans('show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">

        @include('servers.parts.profile')
        @include('servers.parts.description')

    </div>
    <div class="col-md-9">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#activity" data-toggle="tab">Activity</a></li>
                <li class="active"><a href="#runtimes" data-toggle="tab">Runtimes</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="activity">
                    @include('servers.parts.activity.master')
                </div>
                <div class="active tab-pane" id="runtimes">
                    @include('servers.parts.runtimes.master')
                </div>
                <div class="tab-pane" id="settings">
                    Empty
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
