<x-card :pm="$page_module">
    <x-slot name="body">
        <div class="text-gray-900 text-xl">
            <a href="">{{ $title }}</a>
        </div>

        <div class="text-gray-600 mt-3">
            {{ substr($body, 0, 150) }}...
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['body' => $body, 'title' => $title,'page_module' => $page_module]" />

    </x-slot>
</x-card>

