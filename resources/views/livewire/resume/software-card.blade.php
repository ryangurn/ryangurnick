<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
    <div class="border-r border-gray-100 px-5 py-8 w-1/5">
        <div class="text-left">
            <span class="text-lg">software</span>
        </div>
    </div>

    <div class="flex px-2 py-6 w-full">
        <div class="mx-4 w-full">
            <div class="text-gray-600 mt-3">
                {{ $body }}
            </div>

            <livewire:core.card-footer :duration="$updated_at" />
        </div>
    </div>
</div>