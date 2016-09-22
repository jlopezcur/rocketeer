<div class="col-lg-3 col-sm-6 col-xs-12">

    <div class="info-box bg-aqua">
        <span class="info-box-icon">
            <a href="{{ route('issues.index', ['q' => 'milestone:' . $milestone->slug]) }}">
                <i class="fa fa-rocket"></i>
            </a>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">
                <a href="{{ route('issues.index', ['q' => 'milestone:' . $milestone->slug]) }}">
                    {{ $milestone->name }}
                </a>
                <span class="pull-right">
                    <a href="{{ route('projects.milestones.edit', [$project->id, $milestone->slug]) }}"><i class="fa fa-pencil"></i></a>
                    {!! make_remove_dialog([
                        'id' => 'deleteMilestone'.$milestone->id,
                        'link_content' => '<i class="fa fa-times"></i>',
                        'link_class' => '',
                        'content' => 'Are you sure to delete milestone with name: '.$milestone->name.'<br />This process can\'t be undone.',
                        'title' => trans('projects.remove_milestone'),
                        'route' => ['projects.milestones.destroy', $project->id, $milestone->slug]
                    ]) !!}
                </span>
            </span>
            <span class="info-box-number">
                <a href="{{ route('issues.index', ['q' => 'milestone:' . $milestone->slug]) }}">
                    {{ $milestone->issues->count() }}
                </a>
            </span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $milestone->percentage }}%"></div>
            </div>
            <span class="progress-description">
                <a href="{{ route('issues.index', ['q' => 'milestone:' . $milestone->slug]) }}">
                    {{ $milestone->percentage }}% Complete
                </a>
            </span>
        </div>
    </div>

</div>
