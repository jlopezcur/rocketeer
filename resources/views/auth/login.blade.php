@extends('layouts.auth')

@section('content')

    @if($errors->any())
    <div class="alert alert-danger">
        {{$errors->first()}}
    </div>
    @endif

    <p class="login-box-msg">Sign in to start your session</p>

    {!! Form::open(['url' => '/login', 'role' => 'form']) !!}

        <div class="form-group has-feedback">
            {!! Form::text('username', null, ['placeholder' => trans('users.username'), 'class' => 'form-control']) !!}
            <i class="fa fa-envelope-o form-control-feedback"></i>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['placeholder' => trans('users.password'), 'class' => 'form-control']) !!}
            <i class="fa fa-lock form-control-feedback"></i>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
        </div>

    {!! Form::close() !!}

    <a href="#">I forgot my password</a>

@endsection
