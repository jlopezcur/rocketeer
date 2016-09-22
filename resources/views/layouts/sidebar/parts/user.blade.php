@if (Auth::check())
    <div class="user-panel">

            <a href="{{ route('users.show', [Auth::user()->id]) }}" class="pull-left image">
                <img src="http://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=45" class="img-circle" alt="User Image">
            </a>

        <div class="pull-left info">
            <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            <small>{{ Auth::user()->username }}</small>
        </div>
    </div>
@endif
