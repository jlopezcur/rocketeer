@extends('layouts.master')

@section('title')
{{ trans('projects.projects') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.index') }}">{{ trans('projects.projects') }}</a></li>
<li class="active">{{ trans('show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">

        @include('projects.parts.sidebar')

    </div>
    <div class="col-md-9">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                <li><a href="#overview" data-toggle="tab">Overview</a></li>
                <li><a href="#vaults" data-toggle="tab">{!! trans('vaults.vaults') !!}</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    @include('projects.parts.activity')
                </div>
                <div class="tab-pane" id="overview">
                    @include('projects.parts.overview')
                </div>
                <div class="tab-pane" id="vaults">
                    @include('projects.parts.vaults')
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
