<?php $issue = $activity->subject ?>

<li>
    <i class="fa" style="line-height:normal;">
        <a href="{{ route('users.show', [$user->id]) }}">
            <img src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=30" class="img-rounded" style="vertical-align: text-top" alt="User Image">
        </a>
    </i>
    <div class="timeline-item">

        <span class="time">{{ $activity->created_at->diffForHumans() }}</span>

        <h3 class="timeline-header">
            {!! trans('activities.' . $activity->name, [
                'user_id' => $user->id,
                'user_name' => $user->full_name,
                'issue_id' => $issue->id,
                'issue_name' => (isset($issue->name) ? $issue->name : $issue->title),
                'project_slug' => ($activity->project_id ? $activity->project->slug : ''),
                'project_name' => ($activity->project_id ? $activity->project->name : '')
            ]) !!}
        </h3>

        <div class="timeline-body markdown">
            {!! Markdown::convertToHtml($issue->description) !!}
        </div>
    </div>
</li>
