@extends('layouts.master')

@section('title')
{{ trans('users.users') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('users.index') }}">{{ trans('users.users') }}</a></li>
<li class="active">{{ trans('admin.create') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($user, ['route' => ['users.store']]) !!}

        @include('users.form.master')

        {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
