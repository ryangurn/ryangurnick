<div>
    @if ($auth_required && $auth)
    <div aria-hidden="true">
        <div class="h-px"></div>
        <div class="py-2">
            <div class="py-px">
                <div class="h-32"></div>
            </div>
        </div>
    </div>


    <div class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5 z-5">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="p-2 rounded-lg bg-indigo-600 shadow-lg sm:p-3">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center gap-2" x-data="{ add_page_show: false, add_module_show: false, add_menu_show: false, show_plus_menu: false }">
                        <div class="relative inline-block text-left">
                            <div class="flex justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="show_plus_menu = ! show_plus_menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </a>
                            </div>

                            <div x-show="show_plus_menu" class="origin-top-right absolute bottom-14 left-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95">
                                <div class="py-1" role="none">
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="add_page_show = ! add_page_show; show_plus_menu = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        page
                                    </a>
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="add_module_show = ! add_module_show; show_plus_menu = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        module
                                    </a>
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="show_plus_menu = false" wire:click="$emit('openModal', 'core.add.add-gallery', {{ json_encode(['page_id' => $page->id]) }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        gallery
                                    </a>
                                    @if (!$menu_options->isEmpty())
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="add_menu_show = ! add_menu_show">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        menu option
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div x-show="add_page_show" class="flex items-center justify-center gap-2"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90">
                            <input type="text" class="flex items-center justify-center shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="page name" wire:model="page_name" />
                            <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="add_page" x-on:click="add_page_show = false">
                                add
                            </button>
                        </div>
                        <div class="flex items-center justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <div x-show="add_module_show" class="flex items-center justify-center gap-2"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-90">
                                <select class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:model="module_id" >
                                    @if (!$modules->isEmpty())
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="add_module" x-on:click="add_module_show = false">
                                    add
                                </button>
                            </div>
                        </div>
                        @if (!$menu_options->isEmpty())
                        <div class="flex items-center justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <div x-show="add_menu_show" class="flex items-center justify-center gap-2"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-90">
                                <select class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:model="menu_id" >
                                        @foreach($menu_options as $page)
                                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                                        @endforeach
                                </select>
                                <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="add_menu" x-on:click="add_menu_show = false">
                                    add
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="flex gap-2" x-data="{ remove_page_show: false, show_minus_menu: false }">
                        <div class="flex justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <div x-show="remove_page_show" class="flex items-center justify-center gap-2"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-90">
                                <select class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:model="page_id">
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="flex items-center justify-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="delete_page" x-on:click="remove_page_show = false">
                                    remove
                                </button>
                            </div>
                        </div>

                        <div class="relative inline-block text-left">
                            <div class="flex justify-center gap-2 order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="show_minus_menu = ! show_minus_menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                </a>
                            </div>

                            <div x-show="show_minus_menu" class="origin-top-right absolute bottom-14 right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95">
                                <div class="py-1" role="none">
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="remove_page_show = ! remove_page_show; show_minus_menu = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                        </svg>
                                        page
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
