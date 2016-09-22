@extends('layouts.master')

@section('title')
{!! trans('locales.locales') !!}
<a href="{{ route('locales.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('locales.locales') !!}</li>
@endsection

@section('content')
<div class="box">
    <div class="box-body table-responsive no-padding">
        {!! $locales->render() !!}

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>{!! trans('fields.id') !!}</th>
                    <th>{!! trans('fields.name') !!}</th>
                    <th></th>
                </tr>
                @foreach($locales as $locale)
                    <tr>
                        <td>{{ $locale->id }}</td>
                        <td>
                            <a href="{{ route('locales.edit', [$locale->id]) }}">
                                <img src="{{ asset('img/flags/' . $locale->id . '.png') }}" alt="{{ $locale->name }}" />
                                {{ $locale->name }}
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('locales.edit', [$locale->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $locales->render() !!}
    </div>
</div>
@endsection
