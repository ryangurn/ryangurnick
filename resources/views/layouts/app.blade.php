@extends('layouts.base')

@section('title')
    {{ $title }}
@endsection

@section('additional_headers')
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
@endsection

@section('main')
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
@endsection
