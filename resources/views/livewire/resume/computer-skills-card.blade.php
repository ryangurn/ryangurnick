<x-card :pm="$page_module">
    <x-slot name="title">computer skills</x-slot>
    <x-slot name="body">
        <div class="text-gray-600 dark:text-gray-400 mt-3">
            <ul class="text-lg ml-4">
                @if (!$skills->isEmpty())
                    @foreach($skills as $skill)
                        <li class="flex sm:flex-col md:flex-row justify-between pb-4">
                            <a href="#" class="border-b-4 border-solid transition duration-150 ease-in border-b-4 hover:border-red">
                                {{ $skill }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['skills' => $skills, 'page_module' => $page_module]" />
    </x-slot>
</x-card>
