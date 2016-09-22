<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            @if(isset($project->id) && !isset($projects))
                <li>
                    <a href="{{ route('projects.show', $project->slug) }}">
                        <i class="fa fa-briefcase"></i> {{ $project->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}">
                        <i class="fa fa-refresh"></i>
                    </a>
                </li>
            @endif

            @include('layouts.header.parts.languages')

            @include('layouts.header.parts.user')

            <li>
                <a href="{{ url('/') }}" target="_blank"><i class="fa fa-globe"></i></a>
            </li>
        </ul>
    </div>
</nav>
