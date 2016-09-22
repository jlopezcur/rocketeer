<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php $options = App\Project::lists('name', 'id') ?>
            {!! Form::label('project_id', trans('projects.project')) !!}
            {!! Form::select2('project_id', $options) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php $options = App\Server::lists('name', 'id') ?>
            {!! Form::label('server_id', trans('servers.server')) !!}
            {!! Form::select2('server_id', $options) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <?php $options = ['ssh' => 'SSH', 'ftp' => 'FTP'] ?>
    {!! Form::label('type', trans('type')) !!}
    {!! Form::select2('type', $options) !!}
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('port', trans('deployments.port')) !!}
            {!! Form::number('port', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('username', trans('deployments.username')) !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('password', trans('deployments.password')) !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
