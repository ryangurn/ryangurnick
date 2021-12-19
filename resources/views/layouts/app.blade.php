@extends('layouts.base')

@section('title')
    {{ $title }}
@endsection

@section('additional_headers')
    <div class="flex items-center gap-4">
        @can('access telescope')
            <a href="/telescope" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 32 32" fill="currentColor">
                <path d="M21.8,27.4l-6-9c0,0,0,0-0.1,0C15.6,18.2,15.3,18,15,18s-0.6,0.2-0.8,0.4c0,0,0,0-0.1,0l-6,9c-0.3,0.5-0.2,1.1,0.3,1.4  c0.5,0.3,1.1,0.2,1.4-0.3l4.2-6.3V30c0,0.6,0.4,1,1,1s1-0.4,1-1v-7.7l4.2,6.3c0.2,0.3,0.5,0.4,0.8,0.4c0.2,0,0.4-0.1,0.6-0.2  C22,28.5,22.1,27.9,21.8,27.4z"/><g><path d="M21.4,14.9c-0.1,0-0.3,0-0.4-0.1c-0.2-0.1-0.4-0.3-0.5-0.5l-2.9-7.2c-0.2-0.5,0-1.1,0.6-1.3l9-3.6c0.5-0.2,1.1,0,1.3,0.6   l2.9,7.2c0.2,0.5,0,1.1-0.6,1.3l-9,3.6C21.6,14.8,21.5,14.9,21.4,14.9z"/></g><g><path d="M15,20c-2.2,0-4-1.8-4-4s1.8-4,4-4s4,1.8,4,4S17.2,20,15,20z"/></g><path d="M9,16c0-3.3,2.7-6,6-6c0.6,0,1.1,0.1,1.7,0.2l-1-2.4l-9.1,3.6C6.3,11.6,6.2,11.8,6,12C6,12.2,6,12.5,6,12.7l-5.1,2  c-0.5,0.2-0.8,0.8-0.6,1.3l1.4,3.6c0.1,0.2,0.3,0.4,0.5,0.5c0.1,0.1,0.3,0.1,0.4,0.1c0.1,0,0.3,0,0.4-0.1l5.1-2  c0.2,0.2,0.5,0.4,0.8,0.4c0.1,0,0.2,0,0.4-0.1l0.1,0C9.2,17.6,9,16.8,9,16z"/>
                </svg>
            </a>
        @endcan
        @auth
            @can('view site analytics')
            <a href="#" onclick="Livewire.emit('openModal', 'framework.analytics')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
                </svg>
            </a>
            @endcan
            @can('view emails')
            <a href="#" onclick="Livewire.emitTo('framework.email-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z" clip-rule="evenodd" />
                </svg>
            </a>
            @endcan
            @canany(['view maintenance settings', 'view logo settings', 'view name settings', 'view contact settings', 'view gallery settings', 'view footer settings'])
            <a href="#" onclick="Livewire.emitTo('framework.settings-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
            </a>
            @endcanany
            @can('view access controls')
            <a href="#" onclick="Livewire.emitTo('framework.access-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#" onclick="Livewire.emitTo('framework.user-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
            </a>
            @endcan
            @canany(['view application information', 'view logging information', 'view database information', 'view driver information', 'view memcached information', 'view redis information', 'view mail information', 'view misc information', 'view file system information'])
            <a href="#" onclick="Livewire.emitTo('framework.configuration-slideover', 'show')" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                </svg>
            </a>
            @endcanany
        @endauth
        @if (Route::has('login'))
            @auth
                <form method="POST" action="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 border rounded-full p-1 border-black hover:text-gray-300">
                    @csrf

                    <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 hover:text-gray-300 underline" onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
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
