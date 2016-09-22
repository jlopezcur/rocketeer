@extends('layouts.master')

@section('title')
{{ trans('wikis.wikis') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('wikis.index') }}">{{ trans('wikis.wikis') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
{!! Form::model($wiki, ['method' => 'PATCH', 'route' => ['projects.wikis.update', $project->slug, $wiki->slug]]) !!}
<div class="panel">
    <div class="panel-body">
        @include('wikis.parts.form')
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@include('layouts.footer.libs_edit')
