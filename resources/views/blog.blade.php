<x-app-layout>
    <x-slot name="title">
        {{ $page->title . ' | ' }}{{ $sitename->value }}
    </x-slot>

    <x-slot name="menu">
        <livewire:framework.menubar />
    </x-slot>

    <div class="cards-container space-y-6 my-6">
        {{ $identifier }}
        @if(!$modules->isEmpty())
            @foreach($modules as $module)
                @if ($module->enabled)
                    @livewire($module->module->component, ['page_module' => $module])
                @endif

                @if (!$module->enabled && Auth::check())
                    @livewire($module->module->component, ['page_module' => $module])
                @endif

            @endforeach
        @else
            <div class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-900">
                    no modules yet, please add one.
                </span>
            </div>

        @endif
    </div>


    <livewire:core.footer />

    @auth
    <livewire:framework.banner :page="$page" />
    <livewire:framework.email-slideover />
    <livewire:framework.settings-slideover />
    <livewire:framework.configuration-slideover />
    <livewire:framework.access-slideover />
    <livewire:framework.user-slideover />
    @endauth
</x-app-layout>
