<div>
    <x-card>
        <x-slot name="title">gallery</x-slot>
        <x-slot name="body">

            <div class="text-gray-600 mt-3">
                {!! $body !!}
            </div>

            <livewire:core.card-footer :duration="$updated_at" modal="photo.edit-gallery" :modal_parameters="['body' => $body]" />

        </x-slot>
    </x-card>
</div>
