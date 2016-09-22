<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', trans('fields.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => 'Name']) !!}
    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
</div>

<div class="form-group">
    {!! Form::label('due_date', trans('milestones.due_date')) !!}
    {!! Form::date('due_date', null, ['class' => 'form-control']) !!}
</div>
