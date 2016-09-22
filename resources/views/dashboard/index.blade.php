@extends('layouts.master')

@section('title')
Dashboard <small>Control panel</small>
@endsection

@section('breadcrumb')
<li><i class="fa fa-dashboard"></i> Dashboard</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('issues.widgets.latest')
        </div>
        <div class="col-md-6">
            @include('dashboard.parts.first_steps')
        </div>
        <div class="col-md-6">
            @include('dashboard.parts.resume')
        </div>
    </div>

@endsection
