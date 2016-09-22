<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{ asset('img/logo-32.png') }}" alt="Logo" style="max-width:32px; max-height: 32px;" />
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{ asset('img/logo-32.png') }}" alt="Logo" style="max-width:32px; max-height: 32px;" />
            Rocketeer
        </span>
    </a>

    @include('layouts.header.menu')
</header>
