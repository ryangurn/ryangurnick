<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
    <div class="border-r border-gray-100 px-5 py-8 w-1/5">
        <div class="text-left">
            <span class="text-lg">about</span>
        </div>
    </div>

    <div class="flex px-2 py-6 w-full">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="ml-4 w-64 h-46 rounded-xl" />
        <div class="mx-4 w-full">
            <h4 class="text-xl font-semibold">{{ $name }}</h4>
            <div class="text-gray-600 mt-3">
                {{ $body }}
            </div>

            <livewire:core.card-footer :duration="$updated_at" modal="home.edit-about" :modal_parameters="['name' => $name, 'body' => $body]" />
        </div>
    </div>
</div>
