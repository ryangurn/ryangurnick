<div>
    @canany(['add page', 'add module', 'add gallery', 'edit menu', 'delete page'])
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
                        <div class="w-0 flex-1 flex items-center gap-2" x-data="{ show_options_menu: false }">

                            <div class="relative inline-block text-left">
                                @canany(['add page', 'add module', 'add gallery', 'edit menu', 'delete page'])
                                <div class="flex justify-center gap-2 order-3 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                    <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="show_options_menu = ! show_options_menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                </div>
                                @endcan

                                <div x-show="show_options_menu" class="origin-top-right absolute bottom-14 left-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="py-1" role="none">
                                        @can('add page')
                                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" wire:click="$emit('openModal', 'framework.banner.add-page', {{ json_encode(['page_id' => $page->id]) }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                page
                                            </a>
                                        @endcan
                                        @can('add module')
                                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" wire:click="$emit('openModal', 'framework.banner.add-module', {{ json_encode(['page_id' => $page->id]) }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                module
                                            </a>
                                        @endcan
                                        @can('add gallery')
                                            @if (in_array('photo.photo-grid', $allowed_modules))
                                                <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" x-on:click="show_plus_menu = false" wire:click="$emit('openModal', 'core.add.add-gallery', {{ json_encode(['page_id' => $page->id]) }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    gallery
                                                </a>
                                            @endif
                                        @endcan
                                        @if (!$menu_options->isEmpty() && auth()->user()->can('edit menu'))
                                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" wire:click="$emit('openModal', 'framework.banner.add-menu')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                menu
                                            </a>
                                        @endif
                                        @can('delete page')
                                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" wire:click="$emit('openModal', 'framework.banner.remove-page', {{ json_encode(['page_id' => $page->id]) }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                                </svg>
                                                page
                                            </a>
                                        @endcan
                                        @if (!$navigations->isEmpty() && auth()->user()->can('delete menu'))
                                            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50" wire:click="$emit('openModal', 'framework.banner.remove-menu')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                                </svg>
                                                menu
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endcanany
</div>
