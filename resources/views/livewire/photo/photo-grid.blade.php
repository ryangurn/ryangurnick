<div>
    <div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl mb-4">
        <div class="p-4">
            <div class="text-lg pb-2">
                {{ $gallery->name }}
            </div>
            <div class="text-md pb-2">
                {{ $gallery->description }}
            </div>
        </div>
    </div>

    @if (Auth::check())
    <div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
        <div class="flex w-full pb-6">
            <div class="mx-4 w-full">
                <div class="text-gray-600 mt-3">
                    <livewire:core.card-footer :page_module="$page_module" :show_timestamp="false" modal="photo.add-grid" :modal_parameters="['page_module' => $page_module, 'gallery_id' => $gallery_id]" button_text="add" />
                </div>
            </div>
        </div>
    </div>
    @endif

    <ul role="list" class="space-y-12 {{ (Auth::check()) ? 'pt-8' : '' }} sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">
        @if (!$photos->isEmpty())
          @foreach($photos as $photo)
              @if($photo->visible)
        <li>
          <div class="space-y-4" x-data="{ open: false }" @mouseleave="open = false" >
            <div class="aspect-w-3 aspect-h-2 relative w-full" @mouseover="open = true">
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90" class="flex flex-col content-center justify-center m-auto absolute inset-0 mr-2">
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" :modal="$page_module->module->edit_component" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" />
                </div>
                <img class="object-cover shadow-lg rounded-lg" src="{{ $photo->image->file }}" alt="">
            </div>

            <div class="space-y-2">
              <div class="flex">
                @if (isset($photo->location) && $photo->location != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ $photo->location }}
                </span>
                @endif
                @if (isset($photo->date) && $photo->date != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 {{ (isset($photo->location) && $photo->location != null) ? 'ml-2' : '' }}">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ Carbon\Carbon::parse($photo->date)->diffForHumans() }}
                </span>
                @endif
              </div>
              <div class="text-lg leading-6 font-medium space-y-1">
                <p>{{ $photo->caption }}</p>
              </div>
              <ul role="list" class="flex space-x-5">
                <li>
                  <livewire:core.footer-metadata :duration="$updated_at" />
                </li>
              </ul>
            </div>
          </div>
        </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
