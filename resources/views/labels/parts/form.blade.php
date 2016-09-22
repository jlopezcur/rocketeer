<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::label('color', trans('color')) !!}
    {!! Form::color('color', null, ['class' => 'form-control']) !!}
</div>
