<p>
    <div class="pull-right">
        @include('servers.parts.activity.ttl')
    </div>
    <strong><i class="fa fa-bar-chart-o"></i> Ping Chart</strong>
</p>

<div class="box-body">
    <div id="server-ping-chart-placeholder" style="height: 300px; width: 100%;"></div>
</div>

@push('scripts')
<script type="text/javascript">
$(function () {
    var data = [];

    function getServerData() {
        var res = [];
        @foreach($server->ttls()->orderBy('created_at', 'desc')->take(20)->get()->reverse() as $i => $ttl)
            res.push(['{{ $ttl->created_at->toTimeString() }}', {{ $ttl->value }}])
        @endforeach
        return res;
    }

    // Set up the control widget
	var updateInterval = 5000;

	var plot = $.plot("#server-ping-chart-placeholder", [ getServerData() ], {
        grid: { borderColor: "#f3f3f3", borderWidth: 1, tickColor: "#f3f3f3", hoverable: true },
        series: { shadowSize: 0, color: "#3c8dbc", points: { show: true }, lines: { show: true } },
        lines: { fill: true, color: "#3c8dbc" },
        /*yaxis: { min: 0, max: 200 },*/
        xaxis: { show: true, mode: "categories", tickLength: 0 }
    });

    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({ position: "absolute", display: "none", opacity: 0.8 }).appendTo("body");
    $("#server-ping-chart-placeholder").bind("plothover", function (event, pos, item) {
        if (item) {
            var x = item.series.data[item.dataIndex][0], y = item.datapoint[1];
            //console.log(item);
            $("#line-chart-tooltip").html(x + ": " + y + " ms").css({top: item.pageY + 5, left: item.pageX + 5}).fadeIn(200);
        } else {
            $("#line-chart-tooltip").hide();
        }
    });

    function update() {
        plot.setData([getServerData()]);
        // Since the axes don't change, we don't need to call plot.setupGrid()
        plot.setupGrid();
        plot.draw();
        setTimeout(update, updateInterval);
    }

    update();
})
</script>
@endpush
