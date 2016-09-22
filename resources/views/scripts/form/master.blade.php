<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('fields.name')]) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<div class="row">
    <div class="col-md-8">
        @include('scripts.form.editor')
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <?php $options = App\Project::lists('name', 'id')->prepend(trans('fields.none'), 0) ?>
                    {!! Form::label('project_id', trans('projects.project')) !!}
                    {!! Form::select2('project_id', $options) !!}
                </div>

            </div>
            <div class="panel-footer">
                @if(isset($script->id))
                    {!! Form::submit(trans('admin.update'), ['class' => 'btn btn-primary']) !!}
                @else
                    {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) !!}
                @endif
            </div>
        </div>
    </div>
</div>
