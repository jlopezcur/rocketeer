<div class="form-group">
    {!! Form::label('image', trans('image')) !!}
    {!! Form::mediamanager('image') !!}
</div>

<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', trans('fields.name'), ['class' => 'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<div class="form-group @if ($errors->has('slug')) has-error @endif">
    {!! Form::label('slug', trans('fields.slug'), ['class' => 'required']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
</div>

<div class="form-group @if ($errors->has('web')) has-error @endif">
    {!! Form::label('web', trans('fields.web'), ['class' => 'required']) !!}
    {!! Form::text('web', null, ['class' => 'form-control']) !!}
    @if ($errors->has('web')) <p class="help-block">{{ $errors->first('web') }}</p> @endif
</div>

<div class="form-group @if ($errors->has('description')) has-error @endif">
    {!! Form::label('description', trans('fields.description'), ['class' => 'required']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>
