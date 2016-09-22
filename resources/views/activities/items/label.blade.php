<?php $label = $activity->subject ?>

@if ($label != null)
    
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
                    'label_id' => $label->id,
                    'label_name' => $label->name,
                    'label_color' => $label->color,
                    'project_slug' => ($activity->project_id ? $activity->project->slug : ''),
                    'project_name' => ($activity->project_id ? $activity->project->name : '')
                ]) !!}
            </h3>
        </div>
    </li>

@endif
