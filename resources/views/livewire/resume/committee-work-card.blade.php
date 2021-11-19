<x-card :pm="$page_module">
    <x-slot name="title">committee work</x-slot>
    <x-slot name="body">
        <ul class="divide-y divide-gray-200">
            @if (!$institutions->isEmpty())
                @foreach ($institutions as $institution)
                    <li class="py-4 flex">
                        <div class="ml-3 w-full">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2 float-right">
                                {{ $institution['duration'] }}
                            </span>
                            <p class="text-sm font-medium text-gray-900">{{ $institution['organization'] }}</p>
                            <p class="text-sm text-gray-500"><span class="font-semibold">{{ $institution['position'] }}</span> - {{ $institution['location'] }}</p>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" modal="resume.edit.edit-committee-work" :modal_parameters="['institutions' => $institutions, 'page_module' => $page_module]" />
    </x-slot>
</x-card>
