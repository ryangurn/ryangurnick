<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('additional_html_css')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans @yield('additional_body_css') bg-gray-background text-color-900 text-sm lowercase">
<livewire:framework.maintenance-banner />
<header class="flex items-center justify-between px-8 py-4">
    <a href="#" class="flex items-center">
        <x-application-logo class="w-14 h-14" />
        @if (\App\Models\Setting::where('key', '=', 'application.sitename')->first() != null)
        <span class="text-xl">{{ \App\Models\Setting::where('key', '=', 'application.sitename')->first()->value }}</span>
        @endif
    </a>

    @yield('additional_headers')
</header>


@yield('main')

@livewireScripts

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

@livewire('livewire-ui-modal')

</body>
</html>
