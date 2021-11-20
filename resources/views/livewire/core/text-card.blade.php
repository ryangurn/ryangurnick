<x-card :pm="$page_module">
    <x-slot name="title">{{ $header }}</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            {!! $body !!}
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['body' => $body, 'header' => $header, 'page_module' => $page_module]" />

    </x-slot>
</x-card>

