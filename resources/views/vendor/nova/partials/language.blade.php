<dropdown-trigger class="h-9 flex items-center">

    <span class="text-90">
        {{ Config::get('languages')[App::getLocale()] }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != Session::get('applocale'))
                <li>
                    <a href="{{ route('lang.switch', $lang) }}" class="block no-underline text-90 hover:bg-30 p-3">{{$language}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</dropdown-menu>
