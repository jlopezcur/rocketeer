<div class="box">
    <div class="box-body">

        <p><strong>{{ trans('labels.labels') }}</strong></p>
        <p>
            @foreach($issue->labels as $label)
                <a href="{{ route('issues.index', ['q' => 'label:' . $label->name]) }}" style="margin-right: 8px;">
                    <span class="label" style="background: {{ $label->color }}; font-size: 100%;">
                        <i class="fa fa-tag fa-fw"></i> {{ $label->name }}
                    </span>
                </a>
            @endforeach
        </p>
        <hr>

        <p><strong>{{ trans('milestones.milestones') }}</strong></p>
        <p>
            <?php $milestone = $issue->milestone ?>
            @if(isset($milestone->id))
                <a href="{{ route('issues.index', ['q' => 'milestone:' . $milestone->slug]) }}">
                    <i class="fa fa-rocket"></i>
                    {{ $milestone->name }}
                </a> - {{ $milestone->issues->count() }} Issues · {{ $milestone->percentage }}% Complete
                <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ $milestone->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $milestone->percentage }}%">
                        <span class="sr-only">{{ $milestone->percentage }}% Complete</span>
                    </div>
                </div>
            @else
                {!! trans('fields.none') !!}
            @endif
        </p>
        <hr>

        <p><strong>{{ trans('issues.assignee') }}</strong></p>
        <p>
            @if(isset($issue->assignee->id))
                <a href="{{ route('users.show', [$issue->assignee->id]) }}">
                    <img src="http://www.gravatar.com/avatar/{{ md5($issue->assignee->email) }}?s=16" class="img-circle" alt="User Image">
                    {{ $issue->assignee->full_name }}
                </a>
            @else
                {!! trans('fields.none') !!}
            @endif
        </p>
        <hr>

        <?php
        $_comments = $issue->comments()->groupBy('user_id')->get();
        ?>
        <p><strong>{!! trans('comments.participants', ['number' => $_comments->count()]) !!}</strong></p>
        <p>
            @foreach($_comments as $_comment)
                <?php $author = $_comment->author ?>
                <a href="{{ route('users.show', [$author->id]) }}">
                    <img src="http://www.gravatar.com/avatar/{{ md5($author->email) }}?s=20" class="img-rounded" data-toggle="tooltip" title="{{ $author->full_name }}" alt="User Image">
                </a>
            @endforeach
        </p>

    </div>
</div>
