<ul class="timeline" id="user-timeline">
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>

@push('scripts')
<script type="text/javascript">
$(function () {
    var url = '{{ route('activities.index', ['user_id' => $user->id]) }}';
    $.ajax({
        url: url,
        success: function (result) {
            $('#user-timeline').prepend(result);
        },
        dataType: 'html'
    });
});
</script>
@endpush
