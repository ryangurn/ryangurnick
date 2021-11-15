<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex {{ ($page_module->enabled) ? '' : 'border-dashed border-4' }}">
    <div class="border-r border-gray-100 px-5 py-8 w-1/5">
        <div class="text-left">
            <span class="text-lg">{{ $title }}</span>
        </div>
    </div>

    <div class="flex px-2 py-6 w-full">
        @isset($image)
        {{ $image }}
        @endisset
        <div class="mx-4 w-full">
            {{ $body }}
        </div>
    </div>
</div>
