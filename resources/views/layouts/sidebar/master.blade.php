<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        @include('layouts.sidebar.parts.user')

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ Active::pattern('dashboard') }}">
                <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>{!! trans('admin.dashboard') !!}</span></a>
            </li>

            <!--<li class="{{ Active::routePattern('servers.*') }}">
                <a href="{{ route('servers.index') }}"><i class="fa fa-server"></i> <span>{!! trans('servers.servers') !!}</span></a>
            </li>-->

            <li class="{{ Active::routePattern('scripts.*') }}">
                <a href="{{ route('scripts.index') }}"><i class="fa fa-code"></i> <span>{!! trans('scripts.scripts') !!}</span></a>
            </li>

            <li class="{{ Active::routePattern(['projects.index', 'projects.create', 'projects.edit']) }}">
                <a href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i> <span>{!! trans('projects.projects') !!}</span></a>
            </li>

            <li class="{{ Active::routePattern(['issues.*', 'projects.issues.*', 'projects.labels.*', 'projects.milestones.*']) }}">
                <a href="{{ (isset($project->id) && !isset($projects) ? route('projects.issues.index', [$project->slug]) : route('issues.index')) }}"><i class="fa fa-bug"></i> <span>{!! trans('issues.issues') !!}</span></a>
            </li>

            <li class="{{ Active::routePattern(['vaults.*']) }}">
                <a href="{{ route('vaults.index') }}"><i class="fa fa-key"></i> <span>{!! trans('vaults.vaults') !!}</span></a>
            </li>

            <li class="{{ Active::routePattern(['wikis.*']) }}">
                <a href="{{ (isset($project->id) && !isset($projects) ? route('projects.wikis.show', [$project->slug, 'home']) : route('wikis.index')) }}"><i class="fa fa-file-text"></i> <span>{!! trans('wikis.wikis') !!}</span></a>
            </li>

            @if(Auth::user() != null && Auth::user()->role == 'admin')

            <li class="header">ADMINISTRATION</li>

                <li class="{{ Active::routePattern('users.*') }}">
                    <a href="{{ route('users.index') }}"><i class="fa fa-user"></i> <span>{!! trans('users.users') !!}</span></a>
                </li>

                <li class="{{ Active::routePattern('locales.*') }}">
                    <a href="{{ route('locales.index') }}"><i class="fa fa-language"></i> <span>{!! trans('locales.locales') !!}</span></a>
                </li>

            @endif

        </ul>
    </section>
    <!-- /.sidebar -->

</aside>
