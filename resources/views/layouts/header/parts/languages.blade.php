<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php $locale = App\Locale::find(App::getLocale()) ?>
        <img src="{{ asset('img/flags/' . $locale->id . '.png') }}" alt="{{ $locale->name }}" />
    </a>
    <ul class="dropdown-menu">
        @foreach(App\Locale::get() as $locale)
            <li>
                <a href="{{ route('locale.change', ['locale_id' => $locale->id]) }}">
                    <img src="{{ asset('img/flags/' . $locale->id . '.png') }}" alt="{{ $locale->name }}" />
                    {{ $locale->name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
