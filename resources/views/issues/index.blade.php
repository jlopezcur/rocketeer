@extends('layouts.master')

@section('title')
{!! trans('issues.issues') !!}
@if(isset($project->id))
    <a href="{{ route('projects.issues.create', [$project->slug]) }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endif
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
@if(isset($project->id))
    <li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
@endif
<li class="active">{!! trans('issues.issues') !!}</li>
@endsection

@section('content')
@include('issues.parts.index.filters')

<div class="box">
    <div class="box-body no-padding">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="2">
                        @include('issues.parts.index.resume')
                        <div class="pull-right">
                            @include('issues.parts.index.order')
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($issues as $issue)

                    <?php $project = $issue->project ?>
                    <?php $comments = $issue->comments ?>

                <tr>
                    <td style="width:16px;padding-right: 0;">
                        @include('issues.parts.status')
                    </td>
                    <td>
                        <span class="pull-right">

                            @if ($project != null)
                                <a href="{{ route('projects.issues.show', [$project->slug, $issue->id]) }}">
                            @else
                                <a href="#">
                            @endif

                                @if($comments != null && ($counter = $comments->count()) > 0)
                                    {{ $counter }} <i class="fa fa-comments-o"></i>
                                @else
                                    <span class="text-muted">0 <i class="fa fa-comments-o"></i></span>
                                @endif

                            </a>

                            &nbsp;

                            @if ($project != null)
                                <a href="{{ route('projects.issues.edit', [$issue->project->slug, $issue->id]) }}"><i class="fa fa-pencil"></i></a>
                            @else
                                <a href="#"><i class="fa fa-pencil"></i></a>
                            @endif
                        </span>

                        <span style="font-size: 18px; font-weight: semi-bold;">
                            {!! ($issue->status == 'closed' ? '<s>' : '') !!}

                            @if ($project != null)
                                <a href="{{ route('projects.issues.show', [$project->slug, $issue->id]) }}">
                            @else
                                <a href="#">
                            @endif

                                {{ $issue->title }}

                            </a>

                            {!! ($issue->status == 'closed' ? '</s>' : '') !!}

                            @foreach($issue->labels as $label)
                                &nbsp;
                                <a href="{{ url(Request::path() . '?q=label:' . $label->name) }}">
                                    <span class="label" style="background: {{ $label->color }}; padding: 0.1em 0.4em 0.2em; font-size: 65%;">
                                        <i class="fa fa-tag fa-fw"></i> {{ $label->name }}
                                    </span>
                                </a>
                            @endforeach

                            @if(isset($issue->milestone->id))
                                &nbsp;
                                <small>
                                    <a href="{{ url(Request::path() . '?q=milestone:' . $issue->milestone->slug) }}" class="text-muted">
                                        <i class="fa fa-rocket"></i>
                                        {{ $issue->milestone->name }}
                                    </a>
                                </small>
                            @endif
                        </span>

                        <br>

                        <span style="font-size: 14px;">

                            @if(!isset($project->id))
                                @if(isset($issue->project->id))
                                    <a href="{{ route('projects.show', [$issue->project->slug]) }}">{{ $issue->project->name }}</a>
                                    <a href="{{ route('projects.issues.index', [$issue->project->slug]) }}"><i class="fa fa-filter"></i></a>
                                @else
                                    {!! trans('fields.none') !!}
                                @endif
                                <i class="fa fa-angle-right"></i>
                            @endif

                            #{{ $issue->number }}
                            Opened
                            {{ $issue->created_at->diffForHumans() }}
                            by
                            @if(isset($issue->author->id))
                                <a href="{{ route('users.show', [$issue->author->id]) }}">{{ $issue->author->full_name }}</a>
                                <a href="{{ url(Request::path() . '?q=author:' . $issue->author->username) }}"><i class="fa fa-filter"></i></a>
                            @else
                                {!! trans('fields.none') !!}
                            @endif

                            assigned to

                            @if(isset($issue->assignee->id))
                                <a href="{{ route('users.show', [$issue->assignee->id]) }}">{{ $issue->assignee->full_name }}</a>
                                <a href="{{ url(Request::path() . '?q=assignee:' . $issue->assignee->username) }}"><i class="fa fa-filter"></i></a>
                            @else
                                {!! trans('fields.none') !!}
                            @endif

                            and last updated

                            {{ $issue->updated_at->diffForHumans() }}

                        </span>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

{!! $issues->links() !!}

@endsection
