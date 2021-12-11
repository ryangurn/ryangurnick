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
                                        site configuration
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
                                        <div class="text-xs border border-dashed border-black rounded-lg p-2 text-red-800">this information is only editable by adjusting the various configuration files for the application, unfortunately is not changable through this web interface.</div>
                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        application information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Name</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('APP_NAME') != null) ? env('APP_NAME') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">URL</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('APP_URL') != null) ? env('APP_URL') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Environment</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('APP_ENV') != null) ? env('APP_ENV') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Debug</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('APP_DEBUG')) ? 'true' : 'false' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        logging information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Channel</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('LOG_CHANNEL') != null) ? env('LOG_CHANNEL') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Level</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('LOG_LEVEL') != null) ? env('LOG_LEVEL') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        database information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Connection</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('DB_CONNECTION') != null) ? env('DB_CONNECTION') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Host</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('DB_HOST') != null) ? env('DB_HOST') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Port</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('DB_PORT') != null) ? env('DB_PORT') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Database</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('DB_DATABASE') != null) ? env('DB_DATABASE') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Username</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('DB_USERNAME') != null) ? env('DB_USERNAME') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        driver information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Broadcast</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('BROADCAST_DRIVER') != null) ? env('BROADCAST_DRIVER') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Cache</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('CACHE_DRIVER') != null) ? env('CACHE_DRIVER') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Filesystem</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('FILESYSTEM_DRIVER') != null) ? env('FILESYSTEM_DRIVER') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Queue</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('QUEUE_CONNECTION') != null) ? env('QUEUE_CONNECTION') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Session</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('SESSION_DRIVER') != null) ? env('SESSION_DRIVER') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Session Lifetime</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('SESSION_LIFETIME') != null) ? env('SESSION_LIFETIME') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        memcached information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Host</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MEMCACHED_HOST') != null) ? env('MEMCACHED_HOST') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <svg class="mr-1.5 h-2 w-2 text-indigo-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        redis information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Host</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('REDIS_HOST') != null) ? env('REDIS_HOST') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Port</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('REDIS_PORT') != null) ? env('REDIS_PORT') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                            <svg class="mr-1.5 h-2 w-2 text-purple-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        mail information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Mailer</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_MAILER') != null) ? env('MAIL_MAILER') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Host</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_HOST') != null) ? env('MAIL_HOST') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Port</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_PORT') != null) ? env('MAIL_PORT') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Username</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_USERNAME') != null) ? env('MAIL_USERNAME') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Encryption</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_ENCRYPTION') != null) ? env('MAIL_ENCRYPTION') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">From Address</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_FROM_ADDRESS') != null) ? env('MAIL_FROM_ADDRESS') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">From Name</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('MAIL_FROM_NAME') != null) ? env('MAIL_FROM_NAME') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-pink-100 text-pink-800">
                                            <svg class="mr-1.5 h-2 w-2 text-pink-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        misc information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 mb-8 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Telescope Enabled</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('TELESCOPE_ENABLED') != null) ? env('TELESCOPE_ENABLED') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">ipinfo token</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ (env('GEOLOCATION_IPINFO_ACCESS_TOKEN') != null) ? env('GEOLOCATION_IPINFO_ACCESS_TOKEN') : 'empty' }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                        file system information
                                        </span>
                                        <ul role="list" class="divide-y divide-gray-200 mt-2 rounded-lg border border-gray-300">
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">Default</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ config('filesystems.default') }}
                                                    </div>
                                                </div>
                                            </li>
                                            @if (count(config('filesystems.disks')) > 0)
                                                @foreach(config('filesystems.disks') as $disks)
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                    <div class="min-w-0 flex-1">
                                                        <div href="#" class="block focus:outline-none">
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate">disk</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $disks['driver'] }}
                                                    </div>
                                                </div>
                                            </li>
                                                    @if (count($disks) > 0)
                                                        @foreach ($disks as $key => $disk)
                                                            @if ($key != "secret" && $key != "root")
                                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                                <div class="flex justify-between space-x-3 rounded-lg">
                                                                    <div class="min-w-0 flex-1">
                                                                        <div href="#" class="block focus:outline-none">
                                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                                                {{ $key }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500 text-wrap">
                                                                        {{ ($disk != null) ? $disk : 'empty' }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
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
