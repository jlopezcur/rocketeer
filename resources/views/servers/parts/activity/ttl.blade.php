<strong><abbr title="Time To Live">TTL</abbr>:</strong> <span class="server-latency-number">{{ $server->latency }}</span> ms
<a href="javascript:;" onclick="server_ping()" id="btn-server-ping"><i class="fa fa-refresh"></i></a>

@push('scripts')
<script type="text/javascript">
function server_ping() {
    var uri = '{{ route('servers.ping', [$server->id]) }}';
    $('#btn-server-ping i').addClass('fa-spin');
    $.getJSON(uri, function (data) {
        $('#btn-server-ping i').removeClass('fa-spin');
        $('.server-latency-number').text(data);
        var color = 'success';
        if (data > 500) color = 'warning';
        if (data == 0) color = 'danger';
        $('.server-latency-color')
            .removeClass('server-text-danger')
            .removeClass('server-text-warning')
            .removeClass('server-text-success')
            .addClass('server-text-' + color);
    });
}
</script>
@endpush
