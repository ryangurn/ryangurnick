<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
    <div class="border-r border-gray-100 px-5 py-8 w-1/5">
        <div class="text-left">
            <span class="text-lg">education</span>
        </div>
    </div>

    <div class="flex py-6 w-full">
        <div class="mx-4 w-full">
            <ul class="divide-y divide-gray-200">
              @if (!$institutions->isEmpty())
                @foreach($institutions as $institution)
              <li class="py-4 flex">
                <div class="ml-3 w-full">
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2 float-right">
                    {{ $institution['duration'] }}
                  </span>
                  <p class="text-sm font-medium text-gray-900">{{ $institution['organization'] }}</p>
                  <p class="text-sm text-gray-500">{{ $institution['body'] }}</p>
                </div>
              </li>
                @endforeach
              @endif
            </ul>
            <livewire:core.card-footer :duration="$updated_at" modal="resume.edit-education" :modal_parameters="['institutions' => $institutions]" />
        </div>
    </div>
</div>
