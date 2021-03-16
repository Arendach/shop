<dropdown-trigger class="h-9 flex items-center">
    @isset($user->email)
        <img
            src="https://secure.gravatar.com/avatar/{{ md5($user->email) }}?size=512"
            class="rounded-full w-8 h-8 mr-3"
        />
    @endisset

    <span class="text-90">
        {{ $user->name ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ url('/') }}" class="block no-underline text-90 hover:bg-30 p-3" target="_blank">
                {{ translate('Перейти до сайту') }}
            </a>
        </li>
        <li>
            <a href="{{ url('/bridge') }}" class="block no-underline text-90 hover:bg-30 p-3" target="_blank">
                {{ translate('Імпорт') }}
            </a>
        </li>
        <li>
            <a href="{{ url('/page/templates') }}" class="block no-underline text-90 hover:bg-30 p-3" target="_blank">
                {{ translate('Підказки по шаблонам') }}
            </a>
        </li>
        <li>
            <a href="{{ url('/clear_cache') }}" class="text-danger block no-underline text-90 hover:bg-30 p-3" target="_blank">
                {{ translate('Чистка кешу') }}
            </a>
        </li>
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
