<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
    <div class="border-r border-gray-100 px-5 py-8 w-1/5">
        <div class="text-left">
            <span class="text-lg">computer skills</span>
        </div>
    </div>

    <div class="flex px-2 py-6 w-full">
        <div class="mx-4 w-full">
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
        </div>
    </div>
</div>
