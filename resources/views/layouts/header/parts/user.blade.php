<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    @if (Auth::check())
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="http://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=160" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="http://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=160" class="img-circle" alt="User Image">
                <p>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    <small>Member since {{ Auth::user()->created_at }}</small>
                </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="{{ route('users.show', [Auth::user()->id]) }}" class="btn btn-default btn-flat">{!! trans('users.profile') !!}</a>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">{!! trans('auth.logout') !!}</a>
                </div>
            </li>
        </ul>
    @endif
</li>
