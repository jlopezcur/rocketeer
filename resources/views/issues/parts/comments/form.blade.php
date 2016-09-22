<li>
    <i class="fa" style="line-height:normal;">
        <a href="{{ route('users.show', [Auth::user()->id]) }}">
            <img src="http://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=30" class="img-rounded" style="vertical-align: text-top" alt="User Image">
        </a>
    </i>
    <div class="timeline-item">
        <h3 class="timeline-header">
            {!! trans('comments.leave_a_comment') !!}
        </h3>
        <div class="timeline-body">
            {!! Form::model(App\IssueComment::class, ['route' => ['projects.issues.comments.store', $project->slug, $issue->id]]) !!}
                {!! Form::hidden('issue_id', $issue->id) !!}
                <div class="form-group">
                    {!! Form::textarea('comment', null, ['id' => 'comment']) !!}
                </div>
                <div class="text-right">
                    {!! Form::submit(trans('comments.comment'), ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</li>

@push('scripts')
<script type="text/javascript">
$(function () {
    $('#comment').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {
            var converter = new showdown.Converter(),
            html = converter.makeHtml(content);
            callback(html);
        },
        fullscreen: false,
        height: 200,
        imageUpload: true,
        uploadPath: '{{ route('projects.issues.upload', [$project->slug]) }}'
    });
});
</script>
@endpush
