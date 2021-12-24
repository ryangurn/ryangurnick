<x-card :pm="$page_module">
    <x-slot name="title">projects</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            <ul class="text-lg ml-4">
                @if (!$projects->isEmpty())
                    @foreach($projects->sortByDesc('status') as $project)
                        <li class="pb-4">
                            <a href="{{ isset($project['link']) ? $project['link'] : '#' }}" class="flex sm:flex-col md:flex-row justify-between">
                                <div class="border-solid transition duration-150 ease-in border-b-4 hover:border-{{ ($project['status'] == 'current') ? 'green' : 'yellow'}}">
                                    {{ $project['project'] }}
                                </div>
                                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ ($project['status'] == 'current') ? 'green' : 'yellow'}}-100 text-{{ ($project['status'] == 'current') ? 'green' : 'yellow'}}-800 h-6">
                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-{{ ($project['status'] == 'current') ? 'green' : 'yellow'}}-400" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3" />
                            </svg>
                            {{ $project['status'] }}
                        </span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['projects' => $projects, 'page_module' => $page_module]" />

    </x-slot>
</x-card>
