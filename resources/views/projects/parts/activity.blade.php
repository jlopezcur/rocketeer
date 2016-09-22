<ul class="timeline" id="project-timeline">
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>

@push('scripts')
<script type="text/javascript">
$(function () {
    var url = '{{ route('activities.index', ['project_id' => $project->id]) }}';
    $.ajax({
        url: url,
        success: function (result) {
            $('#project-timeline').prepend(result);
        },
        dataType: 'html'
    });
});
</script>
@endpush
