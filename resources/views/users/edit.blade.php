@extends('layouts.master')

@section('title')
{{ trans('users.users') }}
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('users.index') }}">{{ trans('users.users') }}</a></li>
<li class="active">{{ trans('edit') }}</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}

        @include('users.form.master')

        {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>
@endsection
