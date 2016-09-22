@extends('layouts.master')

@section('title')
{{ trans('issues.issues') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li><a href="{{ route('projects.issues.index', [$project->slug]) }}">{{ trans('issues.issues') }}</a></li>
<li class="active">{{ trans('show') }}</li>
@endsection

@section('content')

<div class="pull-right">
    <a href="{{ route('projects.issues.create', [$project->slug]) }}" class="btn btn-primary">{{ trans('admin.create') }}</a>
    <div class="btn-group">
        <div class="btn-group">
            @if ($issue->status == 'closed')
                <a href="{{ route('projects.issues.quick_update', [$project->slug, $issue->id, 'status' => 'open']) }}" class="btn btn-danger">{{ trans('issues.reopen') }}</a>
            @else
                <a href="{{ route('projects.issues.quick_update', [$project->slug, $issue->id, 'status' => 'closed']) }}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    {{ trans('issues.close') }}
                </a>
            @endif
        </div>
        <a href="{{ route('projects.issues.edit', [$issue->project->slug, $issue->id]) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
    </div>
    <a href="{{ URL::previous() }}" class="btn btn-default">{!! trans('back') !!}</a>
</div>

{{-- Title --}}

<h2 style="margin-top:0;">
    {{ $issue->title }}
    <span class="text-muted">#{{ $issue->number }}</span>
</h2>

{{-- Subtitle --}}

<?php
$author_uri = (isset($issue->author->id) ? route('users.show', [$issue->author->id]) : '#');
$author_name = (isset($issue->author->id) ? $issue->author->full_name : trans('fields.none'));
$ago = $issue->created_at->diffForHumans();
$comments = $issue->comments->count();
?>

@include('issues.parts.status', ['size' => 'big'])
&nbsp;

{!! trans('issues.show_subtitle', compact('author_uri', 'author_name', 'ago', 'comments')) !!}

<hr>

<div class="row">
    <div class="col-md-8">
        @include('issues.parts.timeline')
    </div>
    <div class="col-md-4">
        @include('issues.parts.sidebar')
    </div>
</div>





@endsection
