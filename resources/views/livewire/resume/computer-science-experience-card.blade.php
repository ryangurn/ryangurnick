<x-card :pm="$page_module">
    <x-slot name="title">computer science experience</x-slot>
    <x-slot name="body">
        <div class="text-gray-600 mt-3">
            <div class="px-4">
                <div class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl">
                    <div class="grid gap-16 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
                        @if (!$roles->isEmpty())
                            @foreach($roles as $role)
                                <div class="hover:bg-gray-100 hover:border-gray-300 hover:border-1 hover:shadow-lg hover:border-transparent p-3 rounded-lg">
                                    <div class="inline-block">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 mt-2">
                                          {{ $role['duration'] }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2">
                                          {{ $role['location'] }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                                          {{ $role['role'] }}
                                        </span>
                                    </div>
                                    <div class="block mt-4">
                                        <p class="text-xl font-semibold text-gray-900">
                                            {{ $role['company'] }}
                                        </p>
                                        @if (isset($role['body']) && $role['body'] != null)
                                            <p class="mt-3 text-base text-gray-500">
                                                {!! $role['body'] !!}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" modal="resume.edit-computer-science-experience" :modal_parameters="['roles' => $roles, 'page_module' => $page_module]" />
    </x-slot>
</x-card>
