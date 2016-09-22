@extends('layouts.master')

@section('title')
{!! trans('vaults.vault') !!}
<a href="{{ URL::previous() }}" class="btn btn-default btn-xs"><i class="fa fa-undo"></i> {!! trans('back') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li><a href="{{ route('vaults.index') }}">{{ trans('vaults.vaults') }}</a></li>
<li class="active">{{ trans('show') }}</li>
@endsection

@section('content')

<?php $pairs = $vault->pairs()->get() ?>

<div class="row">

    @if($pairs->count() > 0)
    <div class="col-md-8">

        <div class="box box-default">
            <div class="box-body no-padding">

                <table class="table table-condensed table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('vaults.key') }}</th>
                            <th>{{ trans('vaults.value') }}</th>
                            <th>{{ trans('vaults.comment') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pairs as $pair)

                        <tr>
                            <td>@include('vaults.parts._key')</td>
                            <td>@include('vaults.parts._value')</td>
                            <td>{{ $pair->comment }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    @endif

    <div class="{{ ($pairs->count() > 0 ? 'col-md-4' : 'col-md-12') }}">

        <div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">
                    @foreach($vault->getAncestors() as $ancestor)
                        <a href="{{ route('vaults.show', [$ancestor->id]) }}">{{ $ancestor->name }}</a>
                        <i class="fa fa-angle-right"></i>
                    @endforeach
                    {{ $vault->name }} <span class="badge badge-default">{{ $vault->children()->count() }}</span>
                </h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('vaults.edit', $vault->id) }}" class="btn btn-box-tool"><i class="fa fa-edit"></i> {{ trans('edit') }}</a>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($vault->image))
                    <p><a href="{{ $vault->web }}" target="_blank"><img src="{{ asset('system/App/Vault/web/'.$vault->id.'_'.md5($vault->web).'.jpg') }}" alt="" class="img img-light img-responsive" /></a></p>
                @endif

                @if(!empty($vault->web))
                    <p><a href="{{ $vault->web }}" target="_blank"><i class="fa fa-globe"></i> {{ $vault->web }}</a></p>
                @endif

                @if(isset($vault->project->id))
                    <p><a href="{{ route('projects.show', [$vault->project->slug]) }}"><i class="fa fa-briefcase"></i> {{ $vault->project->name }}</a></p>
                @endif

                <p>{{ $vault->description }}</p>

            </div>
        </div>

    </div>
</div>


@foreach($vault->children->chunk(4) as $chunk)
<div class="row">
    @foreach($chunk as $vault)

        @include('vaults.parts.item')

    @endforeach
    <div class="col-md-3">
        <a href="{{ route('vaults.create', ['parent_id' => $vault->id]) }}" class="btn btn-primary">{{ trans('admin.create') }}</a>
    </div>
</div>
@endforeach

@endsection
