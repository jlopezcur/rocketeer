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
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            @include('layouts.header.master')

            @include('layouts.sidebar.master')


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">


                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <h1>
                        @yield('title')
                    </h1>
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    @include('layouts.header.messages')
                    @yield('content')

                </section><!-- /.content -->

            </div><!-- /.content-wrapper -->

            @include('layouts.footer.master')

        </div><!-- ./wrapper -->

        @include('layouts.footer.libs')

    </body>
</html>
