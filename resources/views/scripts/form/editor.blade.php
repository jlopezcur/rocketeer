<div class="form-group">
    {!! Form::hidden('content', null, ['id' => 'content']) !!}
    <div id="editor" style="width:100%; height: 450px;"></div>
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/ace/src/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
$(function () {
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.getSession().setMode("ace/mode/sh");
    editor.setOptions({
        maxLines: Infinity,
        minLines: 15,
    });

    $('#editor').closest('form').on('submit', function () {
        $('#content').val(editor.getValue());
    });
    editor.setValue($('#content').val());
    editor.gotoLine(1);
});
</script>
@endpush
