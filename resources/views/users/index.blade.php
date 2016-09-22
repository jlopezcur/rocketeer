@extends('layouts.master')

@section('title')
{!! trans('users.users') !!}
<a href="{{ route('users.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('admin.dashboard') }}</a></li>
<li class="active">{!! trans('users.users') !!}</li>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <div class="box-tools">{!! $users->render() !!}</div>
    </div>

    <div class="box-body table-responsive no-padding">
        <table class="table table-condensed table-striped table-hover">
            <tbody>
                <tr>
                    <th>{!! trans('fields.id') !!}</th>
                    <th>{!! trans('fields.name') !!}</th>
                    <th>{!! trans('users.username') !!}</th>
                    <th>{!! trans('users.role') !!}</th>
                    <th>{!! trans('users.email') !!}</th>
                    <th>{!! trans('users.created_date') !!}</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <img src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=16" style="vertical-align:middle;" class="img img-circle" />
                            {{ $user->email }}
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('users.transform_into', [$user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-user-md"></i></a>
                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
