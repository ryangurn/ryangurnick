<x-card :pm="$page_module">
    <x-slot name="title">skills</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            <ul class="text-lg ml-4">
                @if (!$skills->isEmpty())
                    @foreach($skills as $skill)
                        <li class="pb-4">
                            <a href="#" class="border-b-4 pb-3 border-solid transition duration-150 ease-in border-b-4 pb-3 hover:border-{{ ($skill['level'] == 'advanced') ? 'gray' : (($skill['level'] == 'proficient') ? 'indigo' : (($skill['level'] == 'moderate') ? 'purple' : (($skill['level'] == 'basic') ? 'pink' : 'orange' ))) }}-500">
                                {{ $skill['skill'] }}
                                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ ($skill['level'] == 'advanced') ? 'gray' : (($skill['level'] == 'proficient') ? 'indigo' : (($skill['level'] == 'moderate') ? 'purple' : (($skill['level'] == 'basic') ? 'pink' : 'orange' ))) }}-100 text-{{ ($skill['level'] == 'advanced') ? 'gray' : (($skill['level'] == 'proficient') ? 'indigo' : (($skill['level'] == 'moderate') ? 'purple' : (($skill['level'] == 'basic') ? 'pink' : 'orange' ))) }}-800">
                                <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-{{ ($skill['level'] == 'advanced') ? 'gray' : (($skill['level'] == 'proficient') ? 'indigo' : (($skill['level'] == 'moderate') ? 'purple' : (($skill['level'] == 'basic') ? 'pink' : 'orange' ))) }}-400" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                {{ $skill['level'] }}
                            </span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['skills' => $skills, 'page_module' => $page_module]" />

    </x-slot>
</x-card>
