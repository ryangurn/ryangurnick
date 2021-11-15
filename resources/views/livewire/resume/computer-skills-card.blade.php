<x-card>
    <x-slot name="title">computer skills</x-slot>
    <x-slot name="body">
        <div class="text-gray-600 mt-3">
            <ul class="text-lg ml-4">
                @if (!$skills->isEmpty())
                    @foreach($skills as $skill)
                        <li class="pb-4">
                            <a href="#" class="border-b-4 pb-3 border-solid transition duration-150 ease-in border-b-4 pb-3 hover:border-red">
                                {{ $skill }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :duration="$updated_at" modal="resume.edit-computer-skills" :modal_parameters="['skills' => $skills]" />
    </x-slot>
</x-card>
