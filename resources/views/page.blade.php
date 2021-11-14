<x-app-layout>
    <x-slot name="title">
        {{ $page->title . ' | ' }}ryangurnick
    </x-slot>

    <div class="cards-container space-y-6 my-6">
        @if(!$modules->isEmpty())
            @foreach($modules as $module)
                @livewire($module->module->component)
            @endforeach
        @endif
    </div>
</x-app-layout>
