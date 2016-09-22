<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('title', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('title', (Request::has('slug') ? studly_case(Request::get('slug')) : null), ['class' => 'form-control input-lg']) !!}
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::hidden('content', null, ['id' => 'content']) !!}
    <div id="content-editor"></div>
</div>

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-markdown-editor/dist/css/bootstrap-markdown-editor.css') }}">
<script src="{{ asset('assets/plugins/ace/src-min/ace.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-markdown-editor/dist/js/bootstrap-markdown-editor.js') }}"></script>
<script src="{{ asset('assets/plugins/showdown/dist/showdown.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('#content-editor').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {
            var converter = new showdown.Converter(),
            html = converter.makeHtml(content);
            callback(html);
        },
        fullscreen: false,
        height: 200,
        imageUpload: true,
        uploadPath: '{{ route('projects.wikis.upload', [$project->slug]) }}'
    });
    $('#content-editor').closest('form').on('submit', function () {
        var content = $('#content-editor').markdownEditor('content');
        $('#content').val(content);
    });
    $('#content-editor').markdownEditor('setContent', $('#content').val());
});
</script>
@endsection
