<div>
    <x-card :pm="$page_module">
        <x-slot name="body">
            <div class="text-lg pb-2">
                {{ $gallery->name }}
            </div>
            <div class="text-md pb-2">
                {{ $gallery->description }}
            </div>
        </x-slot>

        <x-slot name="subBody">
            @auth
                <livewire:core.card-footer :menu_options="[['value' => 'edit gallery', 'modal' => 'photo.edit.edit-gallery-data', 'parameters' => ['page_module' => $page_module, 'gallery_id' => $gallery_id, 'name' => $gallery->name, 'description' => $gallery->description]]]" :page_module="$page_module" :show_timestamp="false" modal="photo.add-grid" :modal_parameters="['page_module' => $page_module, 'gallery_id' => $gallery_id]" button_text="add photo" />
            @endauth
        </x-slot>
    </x-card>

    <ul role="list" class="space-y-12 {{ (Auth::check()) ? 'pt-8' : 'pt-4' }} sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">
        @if (!$photos->isEmpty())
          @foreach($photos as $photo)
              @if($photo->visible)
        <li>
          <div class="space-y-4" x-data="{ open: false }" @mouseleave="open = false" >
            <div class="aspect-w-3 aspect-h-2 relative w-full" @mouseover="open = true" @if(!Auth::check()) wire:click="$emit('openModal', 'photo.view-photo', {{ json_encode(['photo_id' => $photo->id, 'page_module' => $page_module]) }})" @endif>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90" class="flex flex-col content-center justify-center m-auto absolute inset-0 mr-2">
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" modal="photo.view-photo" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" button_text="view" />
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" :modal="$page_module->module->edit_component" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" />
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" modal="photo.remove-grid-photo" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" button_text="remove" />
                </div>
                <img class="object-cover shadow-lg rounded-lg" src="{{ $photo->image->file }}" alt="">
            </div>

            <div class="space-y-2">
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
