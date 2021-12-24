<x-card :pm="$page_module">
    <x-slot name="title">about</x-slot>
    <x-slot name="image"><img src="{{ asset('storage/'.$image) }}" alt="{{ $name }}" class="mr-2 md:mr-0 ml-4 w-auto h-auto md:h-64 md:h-46 rounded-xl object-cover" /></x-slot>
    <x-slot name="body">

        <h4 class="text-xl font-semibold mt-2 md:mt-0">{{ $name }}</h4>
        <div class="text-gray-600 mt-3">
            {{ $body }}
        </div>
    </x-slot>
    <x-slot name="subBody">
        @if ($link != null && $linkText != null)
        <a href="{{ $link }}" class="flex items-center justify-center mt-4 mx-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-600">
            {{ $linkText }}
        </a>
        @endif

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['name' => $name, 'body' => $body, 'link' => $link, 'link_text' => $linkText, 'page_module' => $page_module]" />

    </x-slot>
</x-card>
