@extends('layouts.master')

@section('title')
{{ trans('wikis.wikis') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('projects.show', [$project->slug]) }}"> {{ trans('projects.project') }}: {{ $project->name }}</a></li>
<li><a href="{{ route('projects.wikis.index', [$project->slug]) }}">{{ trans('wikis.wikis') }}</a></li>
<li class="active">{{ trans('show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-10">

        @if(!isset($wiki->id))

            <div class="well well-lg text-center">
                <h2>{!! trans('wikis.no_page_found') !!}</h2>
                <h3><a href="{{ route('projects.wikis.create', [$project->slug, 'slug' => $path]) }}">{!! trans('wikis.do_you_want_to_create') !!}</a></h3>
            </div>

        @else

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        {{ $wiki->title }}
                        <small><br>{{ $wiki->author->full_name }} edited this page on {{ $wiki->created_at->format('d M Y') }}</small>
                    </h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('projects.wikis.edit', [$project->slug, $wiki->slug]) }}" class="btn btn-box-tool"><i class="fa fa-edit"></i> {{ trans('edit') }}</a>
                    </div>
                </div>
                <div class="box-body">
                    {!! Markdown::convertToHtml($wiki->content) !!}
                </div>
            </div>

        @endif

    </div>
    <div class="col-md-2">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pages <span class="badge badge-default">{{ $project->wikis->count() }}</span></h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-stacked">
                    @foreach($project->wikis()->orderby('title', 'asc')->get() as $wiki)
                        <li><a href="{{ route('projects.wikis.show', [$project->slug, $wiki->slug]) }}">{{ $wiki->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="box-footer">
                <a href="{{ route('projects.wikis.index', [$project->slug]) }}">
                    See all pages...
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
