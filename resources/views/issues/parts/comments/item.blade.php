<li>
    <i class="fa" style="line-height:normal;">
        <a href="{{ route('users.show', [$comment->author->id]) }}">
            <img src="http://www.gravatar.com/avatar/{{ md5($comment->author->email) }}?s=30" class="img-rounded" style="vertical-align: text-top" alt="User Image">
        </a>
    </i>
    <div class="timeline-item">
        <span class="time">...</span>
        <h3 class="timeline-header">
            @if(isset($issue->author->id))
                <a href="{{ route('users.show', [$comment->author->id]) }}">
                    {{ $comment->author->full_name }}
                </a>
            @else
                {!! trans('fields.none') !!}
            @endif
            commented
            {{ $comment->created_at->diffForHumans() }}
        </h3>
        <div class="timeline-body markdown">
            {!! Markdown::convertToHtml($comment->comment) !!}
        </div>
    </div>
</li>
