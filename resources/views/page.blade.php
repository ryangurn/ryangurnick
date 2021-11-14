<x-app-layout>
    <x-slot name="title">
        {{ $page->title . ' | ' }}ryangurnick
    </x-slot>

    <x-slot name="menu">
        @if (!$menu->isEmpty())
            @foreach($menu as $menu)
        <li><a href="{{ route($menu->page->name) }}" class="border-b-4 pb-3 border-solid {{ (Route::currentRouteName() == $menu->page->name) ? 'border-blue' : 'text-gray-400 hover:border-blue' }}">{{ $menu->page->title }}</a></li>
            @endforeach
        @endif
    </x-slot>

    <div class="cards-container space-y-6 my-6">
        @if(!$modules->isEmpty())
            @foreach($modules as $module)
                @if ($module->enabled)
                    @livewire($module->module->component)
                @endif
            @endforeach
        @endif
    </div>
</x-app-layout>
