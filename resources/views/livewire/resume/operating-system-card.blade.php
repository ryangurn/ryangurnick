<x-card :pm="$page_module">
    <x-slot name="title">operating system proficiency</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            <ul class="text-lg ml-4">
                @if (!$systems->isEmpty())
                    @foreach($systems as $system)
                        <li class="pb-4">
                            <a href="#" class="border-b-4 pb-3 border-solid transition duration-150 ease-in border-b-4 pb-3 hover:border-yellow">
                                {{ $system }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" modal="resume.edit-operating-system" :modal_parameters="['systems' => $systems, 'page_module' => $page_module]" />

    </x-slot>
</x-card>
