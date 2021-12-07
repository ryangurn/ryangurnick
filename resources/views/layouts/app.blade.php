<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-gray-background text-color-900 text-sm lowercase">
        <header class="flex items-center justify-between px-8 py-4">
            <a href="#" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                </svg>
                <span class="text-xl">Ryan Gurnick</span>
            </a>

            <div class="flex items-center gap-4">
                <a href="/telescope" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    Telescope
                </a>
                @auth
                <a href="#" onclick="Livewire.emit('openModal', 'framework.analytics')" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    Analytics
                </a>
                <a href="#" onclick="Livewire.emitTo('framework.email-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    Contacts
                </a>
                <a href="#" onclick="Livewire.emitTo('framework.settings-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    settings
                </a>
                @endauth
                @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                @endif
                @auth
                <a href="#">
                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?d=mp" alt="avatar" class="w-10 h-10 rounded-full" />
                </a>
                @endauth
            </div>
        </header>

        <main class="container mx-auto max-w-5xl flex">
            <div class="w-full">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex font-semibold border-b-4 pb-3 space-x-10">
                        {{ $menu }}
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>

        @livewireScripts

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        @livewire('livewire-ui-modal')

    </body>
</html>
