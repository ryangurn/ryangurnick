<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ (isset($pageTitle) && $pageTitle != null) ? $pageTitle . ' | ' : '' }}ryangurnick</title>

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

            <div class="flex items-center">
                <a href="/telescope" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    Telescope
                </a>
                @if (Route::has('login'))
                    <div class="top-0 right-0 px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a href="#">
                    <img src="https://www.gravatar.com/avatar/0000?d=mp" alt="avatar" class="w-10 h-10 rounded-full" />
                </a>
            </div>
        </header>

        <main class="container mx-auto max-w-5xl flex">
            <div class="w-full">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex font-semibold border-b-4 pb-3 space-x-10">
                        <li><a href="{{ route('home') }}" class="border-b-4 pb-3 border-solid {{ (Route::currentRouteName() == 'home') ? 'border-blue' : 'text-gray-400 hover:border-blue' }}">Home</a></li>
                        <li><a href="{{ route('photos') }}" class="transition duration-150 ease-in border-b-4 pb-3 {{ (Route::currentRouteName() == 'photos') ? 'border-blue' : 'text-gray-400 hover:border-blue' }}">Photos</a></li>
                        <li><a href="{{ route('resume') }}" class="transition duration-150 ease-in border-b-4 pb-3 {{ (Route::currentRouteName() == 'resume') ? 'border-blue' : 'text-gray-400 hover:border-blue' }}">resume</a></li>
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
