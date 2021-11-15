<x-card>
    <x-slot name="title">about</x-slot>
    <x-slot name="image"><img src="{{ asset($image) }}" alt="{{ $name }}" class="ml-4 w-64 h-46 rounded-xl" /></x-slot>
    <x-slot name="body">

        <h4 class="text-xl font-semibold">{{ $name }}</h4>
        <div class="text-gray-600 mt-3">
            {{ $body }}
        </div>

        <livewire:core.card-footer :duration="$updated_at" modal="home.edit-about" :modal_parameters="['name' => $name, 'body' => $body]" />

    </x-slot>
</x-card>
