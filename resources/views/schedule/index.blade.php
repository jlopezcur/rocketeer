@extends('layouts.master')

@section('title')
Schedule
@endsection

@section('breadcrumb')
<li class="active"><i class="fa fa-calendar"></i> {{ trans('schedule.schedule') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Controls</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input id="event_title" placeholder="Event Title..." class="form-control" value="" type="text">
                </div>
                <button class="btn btn-block btn-purple">Add New Event</button>
                <hr>

                <!-- Draggable Events -->
                <!-- ============================================ -->
                <h4 class="text-thin">Draggable Events</h4>
                <div id="demo-external-events">
                    <div class="fc-event fc-list ui-draggable ui-draggable-handle" data-class="warning">All Day Event</div>
                    <div class="fc-event fc-list ui-draggable ui-draggable-handle" data-class="success">Meeting</div>
                    <div class="fc-event fc-list ui-draggable ui-draggable-handle" data-class="mint">Birthday Party</div>
                    <div class="fc-event fc-list ui-draggable ui-draggable-handle" data-class="purple">Happy Hour</div>
                    <div class="fc-event fc-list ui-draggable ui-draggable-handle">Lunch</div>
                    <hr>
                    <div>
                        <label class="form-checkbox form-normal form-primary form-text">
                            <input id="drop-remove" type="checkbox">
                            Remove after drop
                        </label>
                    </div>
                    <hr>
                    <div class="fc-event ui-draggable ui-draggable-handle" data-class="warning">All Day Event</div>
                    <div class="fc-event ui-draggable ui-draggable-handle" data-class="success">Meeting</div>
                    <div class="fc-event ui-draggable ui-draggable-handle" data-class="mint">Birthday Party</div>
                    <div class="fc-event ui-draggable ui-draggable-handle" data-class="purple">Happy Hour</div>
                    <div class="fc-event ui-draggable ui-draggable-handle">Lunch</div>
                </div>
                <!-- ============================================ -->


            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Controls</h3>
            </div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

@endsection




@section('header_styles')
@parent
<link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('footer_scripts')
@parent
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/lang/es.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('#calendar').fullCalendar({
        header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
        events: [
            @foreach ($issues as $index => $issue)
            {
				title: '#{{ $issue->number }}: {{ $issue->title }}',
				start: '{{ Date::parse($issue->created_at)->format('Y-m-d') }}'
			} {{ ($index < count($issues)-1 ? ',' : '') }}
            @endforeach
        ]
    })
});
</script>
@endsection
