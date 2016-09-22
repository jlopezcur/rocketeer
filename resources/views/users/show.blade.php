@extends('layouts.master')

@section('title')
{!! trans('users.users') !!}
<a href="{{ route('users.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('users.index') }}">{{ trans('users.users') }}</a></li>
<li class="active">{{ trans('admin.show') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=200" alt="User profile picture">
                <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                <p class="text-muted text-center">{{ $user->role }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{!! trans('projects.projects') !!}</b> <a class="pull-right">{{ $user->projects->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{!! trans('issues.issues') !!}</b> <a class="pull-right">{{ $user->issues->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{!! trans('servers.servers') !!}</b> <a class="pull-right">{{ $user->servers->count() }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                <li><a href="#unknown" data-toggle="tab">???</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    @include('users.parts.activity')
                </div>
                <div class="tab-pane" id="unknown">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
