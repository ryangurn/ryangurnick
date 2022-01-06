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
                                        settings
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
                                <div class="grid grid-cols-1 space-y-6 inset-0 px-4 sm:px-6">
                                    @can('view maintenance settings')
                                    <div class="pb-2">
                                        <div class="flex items-center justify-between">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">mainenance mode</span>
                                                <span class="text-sm text-gray-500" id="availability-description">prevent non-administrators from accessing the website.</span>
                                            </span>
                                            <button type="button" class="{{ ($maintenance) ? 'bg-indigo-600' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false" aria-labelledby="availability-label" aria-describedby="availability-description" wire:click="$toggle('maintenance')">
                                                <span aria-hidden="true" class="{{ ($maintenance) ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                            </button>
                                        </div>

                                        @can('update maintenance settings')
                                        <div>
                                            <button type="submit" class="mt-4 bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_maintenance">
                                                save maintenance
                                            </button>
                                        </div>
                                        @endcan

                                    </div>
                                    @endcan

                                    @can('view indexing settings')
                                    <div class="pb-2">
                                        <div class="flex items-center justify-between">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">search engine indexing</span>
                                                <span class="text-sm text-gray-500" id="availability-description">allow search engines to index your website and configure what is allowed.</span>
                                            </span>
                                        </div>

                                        <div x-data="{show: false}" class="pt-2">
                                            <label id="listbox-label" class="sr-only">
                                                Change published status
                                            </label>
                                            <div class="relative">
                                                <div class="inline-flex shadow-sm rounded-md divide-x divide-indigo-600">
                                                    <div class="relative z-0 inline-flex shadow-sm rounded-md divide-x divide-indigo-600">
                                                        <div class="relative inline-flex items-center bg-indigo-500 py-2 pl-3 pr-4 border border-transparent rounded-l-md shadow-sm text-white">
                                                            <!-- Heroicon name: solid/check -->
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p class="ml-2.5 text-sm font-medium">
                                                                {{ $robots[$robots_current]['name'] }}
                                                            </p>
                                                        </div>
                                                        <button type="button" class="relative inline-flex items-center bg-indigo-500 p-2 rounded-l-none rounded-r-md text-sm font-medium text-white hover:bg-indigo-600 focus:outline-none focus:z-10 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" @click="show = !show">
                                                            <span class="sr-only">Change published status</span>
                                                            <!-- Heroicon name: solid/chevron-down -->
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <ul class="origin-top-right absolute z-10 right-0 mt-2 w-72 rounded-md shadow-lg overflow-hidden bg-white divide-y divide-gray-200 ring-1 ring-black ring-opacity-5 focus:outline-none" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-0"
                                                    x-show="show"
                                                    x-transition:enter=""
                                                    x-transition:enter-start=""
                                                    x-transition:enter-end=""
                                                    x-transition:leave="transition ease-in duration-100"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">

                                                    @if(!$robots->isEmpty())
                                                        @foreach($robots as $key => $robot)
                                                    <li class="text-gray-900 hover:text-white hover:bg-indigo-600 cursor-default select-none relative p-4 text-sm" id="listbox-option-0" role="option" @can('update indexing settings') wire:click="update_indexing('{{ $key }}')" @endcan>
                                                        <div class="flex flex-col">
                                                            <div class="flex justify-between">
                                                                <p class="{{ ($key == $robots_current) ? 'font-semibold' : 'font-normal' }}">
                                                                    {{ $robot['name'] }}
                                                                </p>

                                                                @if ($key == $robots_current)
                                                                <span class="text-indigo-500">
                                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </span>
                                                                @endif
                                                            </div>

                                                            <p class="text-gray-500 hover:text-indigo-200 mt-2">
                                                                {{ $robot['description'] }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan

                                    @can('view logo settings')
                                    <div>
                                        <div class="flex items-center justify-between pb-2">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">site logo</span>
                                                <span class="text-sm text-gray-500" id="availability-description">image shown in the header and on all authenication pages.</span>
                                            </span>
                                        </div>
                                        <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">site logo</label>
                                            <input type="file" wire:model="sitelogo" />
                                        </div>
                                        @can('update maintenance settings')
                                        <button type="submit" class="mt-4 bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_sitelogo">
                                            save site logo
                                        </button>
                                        @endcan
                                    </div>
                                    @endcan

                                    @can('view name settings')
                                    <div>
                                        <div class="flex items-center justify-between pb-2">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">site name</span>
                                                <span class="text-sm text-gray-500" id="availability-description">the application name that shows in the header and on each tab in the browser.</span>
                                            </span>
                                        </div>
                                        <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">site title</label>
                                            <input type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="site title" wire:model="sitename">
                                        </div>
                                        @can('update name settings')
                                        <button type="submit" class="mt-4 bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_sitename">
                                            save site title
                                        </button>
                                        @endcan
                                    </div>
                                    @endcan

                                    @can('view contact settings')
                                    <div>
                                        <div class="flex items-center justify-between pb-2">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">contact information</span>
                                                <span class="text-sm text-gray-500" id="availability-description">the settings that control the contacts module.</span>
                                            </span>
                                        </div>
                                        <div class="isolate -space-y-px rounded-md shadow-sm">
                                            <div class="relative border border-gray-300 rounded-md rounded-b-none px-3 py-2 focus-within:z-10 focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                                <label for="name" class="block text-xs font-medium text-gray-700">contact subject</label>
                                                <input type="text" name="name" id="name" class="block border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="new message" wire:model="contact_subject">
                                            </div>
                                            <div class="relative border border-gray-300 rounded-md rounded-t-none px-3 py-2 focus-within:z-10 focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                                <label for="job-title" class="block w-full text-xs font-medium text-gray-700">contact from</label>
                                                <input type="text" name="job-title" id="job-title" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="name@example.com" wire:model="contact_from">
                                            </div>
                                        </div>
                                        @can('update contact settings')
                                        <button type="submit" class="mt-4 bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_contact">
                                            save contact
                                        </button>
                                        @endcan
                                    </div>
                                    @endcan

                                    @can('view gallery settings')
                                    <div>
                                        <div class="flex items-center justify-between pb-2">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">gallery settings</span>
                                                <span class="text-sm text-gray-500" id="availability-description">the settings that adjust the behavior of the gallery, from reactions to comments.</span>
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between pb-4">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">allow reactions</span>
                                                <span class="text-sm text-gray-500" id="availability-description">turn on or off reactions for all galleries.</span>
                                            </span>
                                            <button type="button" class="{{ ($gallery_allow_reactions) ? 'bg-indigo-600' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false" aria-labelledby="availability-label" aria-describedby="availability-description" wire:click="$toggle('gallery_allow_reactions')">
                                                <span aria-hidden="true" class="{{ ($gallery_allow_reactions) ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                            </button>
                                        </div>

                                        <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600 mb-4">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">gallery reactions (limit 10)</label>
                                            <textarea type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="your name" wire:model="gallery_reactions" rows="10"></textarea>
                                        </div>

                                        <div class="flex items-center justify-between pb-4">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">allow comments</span>
                                                <span class="text-sm text-gray-500" id="availability-description">turn on or off comments for all galleries.</span>
                                            </span>
                                            <button type="button" class="{{ ($gallery_allow_comments) ? 'bg-indigo-600' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false" aria-labelledby="availability-label" aria-describedby="availability-description" wire:click="$toggle('gallery_allow_comments')">
                                                <span aria-hidden="true" class="{{ ($gallery_allow_comments) ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                            </button>
                                        </div>

                                        <div class="flex items-center justify-between pb-4">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">allow bad words</span>
                                                <span class="text-sm text-gray-500" id="availability-description">allow bad words within comments in the galleries.</span>
                                            </span>
                                            <button type="button" class="{{ ($gallery_bad_words) ? 'bg-indigo-600' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false" aria-labelledby="availability-label" aria-describedby="availability-description" wire:click="$toggle('gallery_bad_words')">
                                                <span aria-hidden="true" class="{{ ($gallery_bad_words) ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                            </button>
                                        </div>
                                        @can('update gallery settings')
                                        <button type="submit" class="mt-4 bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_gallery">
                                            save gallery
                                        </button>
                                        @endcan
                                    </div>
                                    @endcan

                                    @can('view footer settings')
                                    <div>
                                        <div class="flex items-center justify-between pb-2">
                                            <span class="flex-grow flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" id="availability-label">footer information</span>
                                                <span class="text-sm text-gray-500" id="availability-description">information that is displayed on the footer of the website, including copyright and social links.</span>
                                            </span>
                                        </div>
                                        <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">footer copyright</label>
                                            <input type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="your name" wire:model="footer_copyright">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-7 gap-2">
                                    @if(!$footer_links->isEmpty())
                                        @foreach($footer_links as $key => $links)
                                        <div class="col-span-3 mb-4 relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">footer link #{{ ($key + 1) }} type</label>
                                            <select class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" wire:model="footer_links.{{ $key }}.type">
                                                <option>github</option>
                                                <option>facebook</option>
                                                <option>instagram</option>
                                                <option>twitter</option>
                                                <option>dribble</option>
                                            </select>
                                        </div>

                                        <div class="col-span-3 mb-4 relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                                            <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">footer link #{{ ($key + 1) }} link</label>
                                            <input type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="link here" wire:model="footer_links.{{ $key }}.link">
                                        </div>

                                        <div class="col-span-1 mb-4">
                                            <button type="submit" class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="remove_footer({{ $key }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        @endforeach
                                    @endif
                                        @can('update footer settings')
                                        <div class="col-span-7">
                                            <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save_footer">
                                                save footer
                                            </button>
                                            <button type="submit" class="mt-1 bg-green-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="add_footer">
                                                + add footer link
                                            </button>
                                        </div>
                                        @endcan
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
