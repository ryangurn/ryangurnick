<x-card :pm="$page_module">
    <x-slot name="title">software</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            {{ $body }}
        </div>

        <livewire:core.card-footer :duration="$updated_at" modal="resume.edit-software" :modal_parameters="['body' => $body]" />

    </x-slot>
</x-card>
