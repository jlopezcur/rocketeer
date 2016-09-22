@extends('layouts.master')

@section('title')
{!! trans('vaults.vaults') !!}
<a href="{{ route('vaults.create') }}" class="btn btn-primary btn-xs">{{ trans('admin.create') }}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{{ trans('vaults.vaults') }}</li>
@endsection

@section('content')

{!! $vaults->appends(Request::except('page'))->render() !!}

@foreach($vaults->chunk(4) as $chunk)
<div class="row">
    @foreach($chunk as $vault)

        @include('vaults.parts.item')

    @endforeach
</div>
@endforeach

{!! $vaults->appends(Request::except('page'))->render() !!}

@endsection
