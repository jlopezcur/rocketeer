<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rocketeer</title>
        <link rel="icon" href="img/favicon-32.png" sizes="32x32" type="image/png">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('layouts.header.libs')
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/logo-128.png') }}" alt="Logo" /><br>
                    Rocketeer
                </a>
            </div><!-- /.login-logo -->

            <div class="login-box-body">

                @yield('content')

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        @include('layouts.footer.libs')
    </body>
</html>
