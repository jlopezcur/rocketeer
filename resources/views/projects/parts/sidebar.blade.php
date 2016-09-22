<div class="box box-primary">
    <div class="box-body box-profile">
        @if (!empty($project->image))
            <img class="profile-user-img img-responsive img-circle" src="{{ Croppa::url('thumbs' . $project->image, 128, 128, array('resize')) }}" alt="{{ $project->name }}" />
        @else
            <div class="text-center">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle fa-stack-2x text-blue"></i>
                    <i class="fa fa-briefcase fa-stack-1x text-white"></i>
                </span>
            </div>
        @endif
        <h3 class="profile-username text-center">{{ $project->name }}</h3>
        <p class="text-muted text-center">{{ $project->user->full_name or '' }}</p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <a href="{{ route('deployments.index', ['project_id' => $project->id]) }}">
                    {!! trans('deployments.deployments') !!} <span class="pull-right badge bg-blue">{{ $project->deployments->count() }}</span>
                </a>
            </li>
            <li class="list-group-item">
                @if(($counter = $project->issues()->where('status', 'open')->count()) > 0)
                    {!! trans('issues.issues') !!}
                    <span class="pull-right">
                        <a href="{{ route('projects.issues.index', [$project->slug]) }}">
                            <span class="badge bg-red">
                                {{ $counter }} {!! trans('issues.open') !!}
                            </span>
                        </a>
                        <a href="{{ route('projects.issues.index', [$project->slug, 'q' => 'is:closed']) }}">
                            <span class="badge bg-green">
                                {{ $project->issues()->where('status', 'closed')->count() }} {!! trans('issues.closed') !!}
                            </span>
                        </a>
                    </span>
                @else
                    <a href="{{ route('projects.issues.create', [$project->slug]) }}">
                        {!! trans('issues.issues') !!}
                        <span class="pull-right badge bg-blue">
                            {!! trans('admin.create') !!}
                        </span>
                    </a>
                @endif
            </li>
            <li class="list-group-item">
                <a href="{{ route('projects.wikis.index', [$project->slug]) }}">
                    {!! trans('wikis.wikis') !!} <span class="pull-right badge bg-blue">{{ $project->wikis->count() }}</span>
                </a>
            </li>
        </ul>

        <a href="{{ route('projects.edit', [$project->slug]) }}" class="btn btn-primary btn-block"><b><i class="fa fa-pencil"></i> {!! trans('admin.edit') !!}</b></a>
        <a href="{{ $project->web }}" target="_blank" class="btn btn-default btn-block"><b><i class="fa fa-link"></i> {!! trans('fields.web') !!}</b></a>
    </div>
</div>
