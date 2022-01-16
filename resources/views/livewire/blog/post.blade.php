<x-card :pm="$page_module">
    <x-slot name="body">
        <div class="text-gray-900 dark:text-gray-400 text-xl">
            @if ($page_module->page->page_type->name != "post")
            <a href="{{ route('post', $hash) }}">{{ $title }}</a>
            @else
            {{ $title }}
            @endif
        </div>

        <div class="text-gray-600 dark:text-gray-500 mt-3">
            @if ($page_module->page->page_type->name != "post")
            {{ substr($body, 0, 150) }}...
            @else
            {{ $body }}
            @endif
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['body' => $body, 'title' => $title,'page_module' => $page_module]" />

    </x-slot>
</x-card>

