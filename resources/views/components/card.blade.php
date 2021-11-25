<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl {{ ($page_module->enabled) ? '' : 'border-dashed border-4' }}">
    <div class="flex">
        <div class="border-r border-gray-100 px-5 py-8 w-1/5">
            <div class="text-left grid grid-cols-1">
                <div>
                    <span class="text-lg">{{ $title }}</span>
                </div>
                @if (!$page_module->enabled)
                    <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Draft
                    </span>
                    </div>
                @endif
            </div>
        </div>

        <div class="px-2 py-6 w-full">
            <div class="flex">
                @isset($image)
                    {{ $image }}
                @endisset
                <div class="mx-4 w-full">
                    {{ $body }}
                </div>
            </div>
            @isset($subBody)
                {{ $subBody }}
            @endisset
        </div>
    </div>

</div>
