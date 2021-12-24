<div>
    @can('view access controls')
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
                                            access control
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
                                        <div class="relative">
                                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                <div class="w-full border-t border-gray-300"></div>
                                            </div>
                                            <div class="relative flex justify-center">
                                                <button type="button" class="inline-flex items-center shadow-sm px-4 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="$emit('openModal', 'framework.add-role')">
                                                    <!-- Heroicon name: solid/plus-sm -->
                                                    <svg class="-ml-1.5 mr-1 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span>role</span>
                                                </button>
                                            </div>
                                        </div>

                                    @if (!$roles->isEmpty())
                                        @foreach($roles as $role)
                                        <div class="relative pb-2">
                                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                <div class="w-full border-t border-gray-300"></div>
                                            </div>
                                            <div class="relative flex items-center justify-between">
                                                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                                                {{ $role->name }} role
                                                </span>
                                                @can('update roles')
                                                <button type="button" class="inline-flex items-center shadow-sm px-4 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="$emit('openModal', 'framework.edit-role', {{ json_encode(['role_id' => $role->id]) }})">
                                                    <!-- Heroicon name: solid/plus-sm -->
                                                    <svg class="-ml-1.5 mr-1 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    <span>update</span>
                                                </button>
                                                @endcan
                                            </div>
                                        </div>


                                        <div class="flex flex-col pb-2">
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Permissions
                                                                </th>
                                                                <th scope="col" class="relative px-6 py-3 text-right">
                                                                    @can('associate permissions')
                                                                    <a wire:click="$emit('openModal', 'framework.add-permission', {{ json_encode(['role_id' => $role->id]) }})" class="text-indigo-600 hover:text-indigo-900">add</a>
                                                                    @endcan
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                            @if (!$role->permissions->isEmpty())
                                                                @foreach($role->permissions as $permission)
                                                            <tr>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                    {{ $permission->name }}
                                                                </td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                                                    @can('delete roles')
                                                                    <a wire:click="remove({{ $role->id }}, {{ $permission->id }})" class="text-indigo-600 hover:text-indigo-900">delete</a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                        no permissions assigned to {{ $role->name }}
                                                                    </td>
                                                                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                            </tbody>
                                                        </table>
                                                    </div>
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
    @endcan
</div>
