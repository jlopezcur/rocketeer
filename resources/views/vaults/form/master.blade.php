<div class="row">

    <div class="col-md-4">

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans('fields.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('web') ? 'has-error' : '' }}">
            {!! Form::label('web', trans('web')) !!}
            {!! Form::text('web', null, ['class' => 'form-control']) !!}
            {!! $errors->first('web', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('description')) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <?php $options = App\Project::lists('name', 'id')->prepend(trans('fields.none'), 0) ?>
            {!! Form::label('project_id', trans('projects.project')) !!}
            {!! Form::select2('project_id', $options) !!}
        </div>

    </div>

    <div class="col-md-8">

        @include('vaults.form.pairs')

    </div>

</div>
