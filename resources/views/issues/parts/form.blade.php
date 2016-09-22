<div class="row">

    <div class="col-md-8">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control input-lg', 'placeholder' => 'Title']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('description', null, ['id' => 'description']) !!}
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group">
            <?php $options = $project->labels->lists('name', 'id') ?>
            <?php $selected = []; $selected = $issue->labels->pluck('id')->toArray() ?>
            {!! Form::label('labels[]', trans('labels.labels')) !!}
            {!! Form::select2multiple('labels[]', $options, $selected); !!}
        </div>

        <div class="form-group">
            <?php $options = App\User::lists('first_name', 'id')->prepend('- None -', 0) ?>
            {!! Form::label('assignee_id', 'Assignee') !!}
            {!! Form::select2('assignee_id', $options); !!}
        </div>

        <div class="form-group">
            <?php $options = $project->milestones->lists('name', 'id')->prepend('- None -', 0); ?>
            {!! Form::label('milestone_id', 'Milestone') !!}
            {!! Form::select2('milestone_id', $options); !!}
        </div>

    </div>

</div>

@push('scripts')
<script type="text/javascript">
$(function () {
    $('#description').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {
            var converter = new showdown.Converter(),
            html = converter.makeHtml(content);
            callback(html);
        },
        imageUpload: true,
        uploadPath: '{{ route('projects.issues.upload', [$project->slug]) }}'
    });
});
</script>
@endpush
