@extends('layouts.master')

@section('title')
{!! trans('milestones.milestones') !!}
<a href="{{ route('projects.milestones.create', [$project->slug]) }}" class="btn btn-primary btn-xs">{{ trans('admin.create') }}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li class="active">{!! trans('milestones.milestones') !!}</li>
@endsection

@section('content')

{!! $milestones->appends(Request::except('page'))->render() !!}

@foreach(array_chunk($milestones->getCollection()->all(), 4) as $row)
<div class="row">

    @foreach($row as $milestone)

        @include('milestones.parts.item')

    @endforeach
</div>
@endforeach

{!! $milestones->appends(Request::except('page'))->render() !!}

@endsection
