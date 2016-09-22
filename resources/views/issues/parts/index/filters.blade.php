{!! Form::open(['url' => Request::path(), 'method' => 'GET']) !!}
<div class="row">

    <div class="{{ (isset($project->id) ? 'col-md-8' : 'col-md-12') }}">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-btn">
                    {!! Form::submit(trans('admin.filter'), ['class' => 'btn btn-default']) !!}
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url(Request::path() . '?q=is:open') }}">{!! trans('issues.open_issues') !!}</a></li>
                        <li><a href="{{ url(Request::path() . '?q=author:' . Auth::user()->username) }}">{!! trans('issues.your_issues') !!}</a></li>
                        <li><a href="{{ url(Request::path() . '?q=assignee:' . Auth::user()->username) }}">{!! trans('issues.everything_asigned_to_you') !!}</a></li>
                        <li><a href="{{ url(Request::path() . '?q=mentions:' . Auth::user()->username) }}">{!! trans('issues.everything_mentioning_you') !!}</a></li>
                    </ul>
                </div>
                {!! Form::text('q', (Request::has('q') ? Request::get('q') : 'is:open '), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
            </div>
        </div>
    </div>

    @if(isset($project->id))
        <div class="col-md-4 text-right">
            <div class="form-group">
                <div class="btn-group">
                    <a href="{{ route('projects.labels.index', [$project->slug]) }}" class="btn btn-default">{!! trans('labels.labels') !!}</a>
                    <a href="{{ route('projects.milestones.index', [$project->slug]) }}" class="btn btn-default">{!! trans('milestones.milestones') !!}</a>
                </div>
            </div>
        </div>
    @endif

</div>
{!! Form::close() !!}

@if(Request::has('q') && trim(Request::get('q')) != 'is:open')
<div class="form-group">
    <a href="{{ url(Request::path()) }}" class="text-muted" style="font-size: 16px;">
        <small>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </span>
        </small>
        Clear currently search query, filters and sorts.
    </a>
</div>
@endif
