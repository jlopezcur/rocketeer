<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label('title', 'Title/Question') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! Form::label('status', 'Estado') !!}
                    {!! Form::select('status', ['COMPLETO' , 'PENDIENTE' , 'SIN REVISAR'], ['class' => 'form-control', 'placeholder' => 'Estado']) !!}
                    {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                    {!! Form::label('priority', 'Priodidad') !!}
                    {!! Form::select('priority', ['ALTA' , 'MEDIA' , 'BAJA'], ['class' => 'form-control', 'placeholder' => 'Prioridad']) !!}
                    {!! $errors->first('priority', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>


        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
        </div>



    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('resolved_to') ? 'has-error' : '' }}">
                    {!! Form::label('resolved_to', 'Resuelto por') !!}
                    {!! Form::select('resolved_to', $users, null) !!}
                    {!! $errors->first('resolved_to', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : '' }}">
                    {!! Form::label('assigned_to', 'Asignado a') !!}
                    {!! Form::select('assigned_to', $users, null) !!}
                    {!! $errors->first('assigned_to', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>


</div>
