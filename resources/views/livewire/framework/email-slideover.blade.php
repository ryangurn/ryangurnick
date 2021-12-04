<div x-data="{show: @entangle('show')}">
    <div x-show="show" class="fixed inset-y-0 right-0 pl-10 max-w-full flex"
         x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">

        <div class="w-screen max-w-md">
            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                <div class="px-4 sm:px-6">
                    <div class="mt-4 flex items-start justify-between">
                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                            contacts
                        </h2>
                        <div class="ml-3 h-7 flex items-center">
                            <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="hide">
                                <span class="sr-only">Close panel</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-6 relative flex-1 px-4 sm:px-6">
                    <!-- Replace with your content -->
                    <div class="absolute inset-0 px-4 sm:px-6">
                        {{--                    <div class="h-full border-2 border-dashed border-gray-200" aria-hidden="true"></div>--}}
                    </div>
                    <!-- /End replace -->
                </div>
            </div>
        </div>
    </div>
</div>
