<?php
$projects = App\Project::orderBy('name', 'asc')->lists('name', 'slug');
$users = App\User::orderBy('name', 'asc')->lists('name', 'id');
?>

{!! Form::open(['route' => 'tickets.index', 'method' => 'GET']) !!}
<div class="row">

    <div class="col-md-4" id="filterSearch">
        <div class="form-group">
            {!! Form::label('search', 'Search') !!}
            {!! Form::text('search', Request::get('search'), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
        </div>
    </div>

    <div class="col-md-2" id="filterProject" style="display:none;">
        <div class="form-group">
            {!! Form::label('project', 'Project') !!}
            {!! Form::select('project', $projects, Request::get('project'), ['multiple' => 'multiple', 'class' => 'form-control', 'placeholder' => 'Project']) !!}
        </div>
    </div>

    <div class="col-md-2" id="filterAssignedTo" style="display:none;">
        <div class="form-group">
            {!! Form::label('assigned_to', 'Assigned To') !!}
            {!! Form::select('assigned_to', $users, Request::get('assigned_to'), ['multiple' => 'multiple', 'class' => 'form-control', 'placeholder' => 'Assigned To']) !!}
        </div>
    </div>

    <div class="col-md-2" id="filterOwner" style="display:none;">
        <div class="form-group">
            {!! Form::label('user_id', 'Owner') !!}
            {!! Form::select('user_id', $users, Request::get('user_id'), ['multiple' => 'multiple', 'class' => 'form-control', 'placeholder' => 'Owner']) !!}
        </div>
    </div>

    <div class="col-md-2">
        {!! Form::label('', 'Actions') !!}<br>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-plus"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="javascript:;" onclick="toggleFilter('filterProject')" id="btnFilterProject">Project</a></li>
                <li><a href="javascript:;" onclick="toggleFilter('filterComponent')" id="btnFilterComponent">Component</a></li>
                <li><a href="javascript:;" onclick="toggleFilter('filterMilestone')" id="btnFilterMilestone">Milestone</a></li>
                <li><a href="javascript:;" onclick="toggleFilter('filterAssignedTo')" id="btnFilterAssignedTo">Assigned To</a></li>
                <li><a href="javascript:;" onclick="toggleFilter('filterOwner')" id="btnFilterOwner">Owner</a></li>
            </ul>
        </div>

        {!! Form::submit(trans('tickets.filter'), ['class' => 'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}

<div class="clearfix"></div>

@section('footer_scripts')
@parent
<script type="text/javascript">
$(function () {
    <?php if (!empty(Request::get('project'))) : ?>$('#filterProject').show();<?php endif; ?>
    <?php if (!empty(Request::get('component'))) : ?>$('#filterComponent').show();<?php endif; ?>
    <?php if (!empty(Request::get('milestone'))) : ?>$('#filterMilestone').show();<?php endif; ?>
    <?php if (!empty(Request::get('assigned_to'))) : ?>$('#filterAssignedTo').show();<?php endif; ?>
    <?php if (!empty(Request::get('user_id'))) : ?>$('#filterOwner').show();<?php endif; ?>
    $('select').select2();
});
function toggleFilter(block) {
    $('#'+block).toggle();
    $('select').select2();
}
</script>
@endsection
