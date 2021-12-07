<div x-data="{show: @entangle('show')}">
    <div x-show="show" class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0" aria-hidden="true">
                <div x-show="show" class="fixed inset-y-0 right-0 pl-10 max-w-full flex"
                     x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full">

                    <div class="w-screen max-w-md">
                        <div @click.away="show = false" class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
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
                                <div class="absolute inset-0 px-4 sm:px-6">
                                    <div class="accordion accordion-flush">
                                    @if (!$emails->isEmpty())
                                        @foreach($emails as $email)
                                            <div class="accordion-item border-t-0 border-l-0 border-r-0 rounded-none bg-white border border-gray-200" x-data="{ show_{{ $email->id }}: false }">
                                                <h2 class="accordion-header mb-0">
                                                    <button class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none gap-2" type="button" x-on:click="show_{{ $email->id }} = ! show_{{ $email->id }}">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                                            {{ $email->parameters['first_name'] }} {{ $email->parameters['last_name'] }}
                                                        </span>
                                                        @if ($email->parameters['company'] != null)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                                            {{ $email->parameters['company'] }}
                                                        </span>
                                                        @endif
                                                        @if ($email->parameters['phone_number'] != null)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-blue-100 text-blue-800">
                                                            {{ $email->parameters['phone_number'] }}
                                                        </span>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div x-show="show_{{ $email->id }}" class="accordion-collapse border-0 collapse show">
                                                    <div class="accordion-body py-4 px-5">
                                                        <iframe class="w-full h-100" src="{{ route('mailable', $email) }}"></iframe>
                                                        <a href="#" wire:click="read({{ $email->id }})" class="mt-4 inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-yellow-100 text-yellow-800">
                                                            mark as read
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
