<div class="form-group @if ($errors->has('id')) has-error @endif">
    {!! Form::label('id', trans('fields.id'), ['class' => 'required']) !!}
    {!! Form::text('id', null, ['class' => 'form-control']) !!}
    @if ($errors->has('id')) <p class="help-block">{{ $errors->first('id') }}</p> @endif
</div>

<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>
