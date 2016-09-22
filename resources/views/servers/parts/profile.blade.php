<!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        <div class="text-center">
            <span class="fa-stack fa-4x text-center">
                <i class="fa fa-circle fa-stack-2x server-latency-color server-text-{{ $server->color }}"></i>
                <i class="fa fa-server fa-stack-1x text-white"></i>
            </span>
        </div>

        <h3 class="profile-username text-center">{{ $server->name }}</h3>
        <p class="text-muted text-center">
            <a href="http://{{ $server->host }}" target="_blank">{{ $server->host }}</a> /
            <a href="http://{{ $server->ip }}" target="_blank">{{ $server->ip }}</a>
        </p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <a href="{{ route('deployments.index', ['server_id' => $server->id]) }}">
                    {!! trans('deployments.deployments') !!} <span class="pull-right">{{ $server->deployments->count() }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
