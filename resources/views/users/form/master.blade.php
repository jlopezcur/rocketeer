<div class="row">
    <div class="col-md-8">

        <h3>{!! trans('users.personal_data') !!}</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                    {!! Form::label('first_name', trans('users.first_name'), ['class' => 'required']) !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group @if ($errors->has('last_name')) has-error @endif">
                    {!! Form::label('last_name', trans('users.last_name'), ['class' => 'required']) !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email', trans('users.email')) !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

    </div>
    <div class="col-md-4">
        <h3>{!! trans('users.access_data') !!}</h3>

        <div class="form-group @if ($errors->has('username')) has-error @endif">
            {!! Form::label('username', trans('users.username'), ['class' => 'required']) !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
            @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
        </div>

        <div class="form-group @if ($errors->has('password')) has-error @endif">
            {!! Form::label('password', trans('users.password'), ['class' => 'required']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
            <p class="help-block">Leave empty for not edit.</p>
        </div>

        <div class="form-group @if ($errors->has('confirm')) has-error @endif">
            {!! Form::label('confirm', trans('users.confirm'), ['class' => 'required']) !!}
            {!! Form::password('confirm', ['class' => 'form-control']) !!}
            @if ($errors->has('confirm')) <p class="help-block">{{ $errors->first('confirm') }}</p> @endif
        </div>

        @if(Auth::user()->role == 'admin')
            <?php $roles = ['user' => 'User', 'admin' => 'Admin']; ?>
            <div class="form-group">
                {!! Form::label('role', trans('users.role')) !!}
                {!! Form::select2('role', $roles) !!}
            </div>
        @endif
    </div>
</div>
