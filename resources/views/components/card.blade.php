<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white dark:bg-gray-700 rounded-xl {{ ($page_module->enabled) ? '' : 'border-dashed border-4' }}">
    <div class="flex flex-col md:flex-row md:flex-1">
        @isset($title)
        <div class="border-b md:border-b-0 md:border-r border-gray-100 dark:border-gray-500 px-6 md:px-5 py-2 md:py-8 w-auto md:w-1/5">
            <div class="text-left grid grid-cols-1">
                <div>
                    <span class="text-lg text-black dark:text-white">{{ $title }}</span>
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
        @endisset

        <div class="px-2 py-6 w-full">
            <div class="flex flex-col md:flex-row">
                @isset($image)
                    {{ $image }}
                @endisset
                <div class="mx-4 w-full dark:text-gray-400 pr-8 md:pr-0">
                    {{ $body }}
                </div>
            </div>
            <div>
                @isset($subBody)
                    {{ $subBody }}
                @endisset
            </div>
        </div>
    </div>

</div>
