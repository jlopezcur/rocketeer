<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::label('host', trans('servers.host')) !!}
    {!! Form::text('host', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ip', trans('servers.ip')) !!}
    {!! Form::text('ip', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('description')) !!}
    {!! Form::summernote('description') !!}
</div>
