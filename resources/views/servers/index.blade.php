@extends('layouts.master')

@section('title')
{!! trans('servers.servers') !!}
<a href="{{ route('servers.create') }}" class="btn btn-primary btn-xs">{!! trans('admin.create') !!}</a>
@endsection

@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {!! trans('admin.dashboard') !!}</a></li>
<li class="active">{!! trans('servers.servers') !!}</li>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
@endpush

@section('content')

{!! $servers->render() !!}

@foreach($servers->chunk(3) as $chunk)

    <div class="row">

        @foreach($chunk as $server)

            <div class="col-md-4">

                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header server-bg-{{ $server->color }}">
                        <div class="widget-user-image">
                            <a href="{{ route('servers.show', [$server->id]) }}">
                                <span class="fa-stack fa-2x fa-pull-left">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-server fa-stack-1x server-text-{{ $server->color }}"></i>
                                </span>
                            </a>
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">
                            <a href="{{ route('servers.show', [$server->id]) }}">
                                #{{ $server->id }}: {{ $server->name }}
                            </a>
                        </h3>
                        <h5 class="widget-user-desc">
                            <a href="http://{{ $server->host }}" target="_blank">{{ $server->host }}</a>
                            <span class="text-white">/</span>
                            <a href="http://{{ $server->ip }}" target="_blank">{{ $server->ip }}</a>
                        </h5>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-stacked">
                            <li>
                                <a href="{{ route('deployments.index', ['server_id' => $server->id]) }}">
                                    {!! trans('deployments.deployments') !!} <span class="pull-right badge bg-blue">{{ $server->deployments->count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer">
                        TTL: {{ $server->latency }} ms
                        <span id="sparkline-{{ $server->id }}"></span>
                        {{-- dd($server->ttls()->latest()->groupBy(function($item) {
                            return dd(Carbon\Carbon::parse($item->created_at)->format('Y'));
                        })->get()) --}}
                        @push('scripts')
                        <script type="text/javascript">
                        $(function () {
                            $("#sparkline-{{ $server->id }}").sparkline({!! $server->ttls()->latest()->take(20)->lists('value', 'id')->reverse()->flatten() !!}, {type: 'line'});
                        });
                        </script>
                        @endpush
                        <div class="pull-right">
                            <a href="{{ route('servers.edit', [$server->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            {!! make_remove_dialog([
                                'id' => 'delete'.$server->id,
                                'link_content' => '<i class="fa fa-trash"></i>',
                                'link_class' => 'btn btn-danger btn-xs',
                                'content' => trans('are_you_sure_delete', ['name' => $server->name]),
                                'title' => trans('delete'),
                                'route' => ['servers.destroy', $server->id]
                                ]) !!}
                        </div>
                    </div>
                </div>

            </div>

        @endforeach

    </div>

@endforeach

{!! $servers->render() !!}

@endsection
