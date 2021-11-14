<div>
    @if ($auth_required && $auth)
    <div class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5 z-50">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="p-2 rounded-lg bg-indigo-600 shadow-lg sm:p-3">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center gap-2" x-data="{ add_page_show: false }">
                        <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="add_page_show = ! add_page_show">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            page
                        </a>
                        <div x-show="add_page_show" class="flex items-center justify-center gap-2"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90">
                            <input type="text" class="flex items-center justify-center shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="page name" />
                            <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                save
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto" x-data="{ add_module_show: false }">
                        <div x-show="add_module_show" class="flex items-center justify-center gap-2"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90">
                            <select class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                @if (!$modules->isEmpty())
                                    @foreach($modules as $module)
                                <option>{{ $module->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                save
                            </button>
                        </div>
                        <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50 ml-2" x-on:click="add_module_show = ! add_module_show">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            module
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
