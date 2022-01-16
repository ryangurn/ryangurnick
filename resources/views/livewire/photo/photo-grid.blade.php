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
                <livewire:core.card-footer :menu_options="[['value' => 'edit gallery', 'modal' => 'photo.edit.edit-gallery-data', 'parameters' => ['page_module' => $page_module, 'gallery_id' => $gallery_id, 'name' => $gallery->name, 'description' => $gallery->description]]]" :page_module="$page_module" :show_timestamp="false" modal="photo.add.add-grid" :modal_parameters="['page_module' => $page_module, 'gallery_id' => $gallery_id]" button_text="add photo" :show_menu="true" />
            @endauth
        </x-slot>
    </x-card>

    @can('view photo analytics')
    <div class="mt-8">
        <x-card :pm="$page_module">
            <x-slot name="body">
                <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @if (!$photos->isEmpty())
                        @foreach($photos as $photo)
                    <li class="col-span-1 flex shadow-sm rounded-md">
                        <div class="flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md">
                            <img src="{{ $photo->image->file }}" class="rounded-l-md" />
                        </div>
                        <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 dark:border-gray-500 bg-white dark:bg-gray-700 rounded-r-md truncate">
                            <div class="flex-1 px-4 py-2 text-sm truncate">
                                <p class="text-gray-900 font-medium hover:text-gray-600 dark:text-white dark:hover:text-gray-400">unique views</p>
                                <p class="text-gray-500 dark:text-gray-400">{{ $photo->statistic_images->count() }} views</p>
                            </div>
                        </div>
                    </li>
                        @endforeach
                    @else
                        <li class="col-span-1 flex shadow-sm rounded-md">
                            <div class="flex-shrink-0 flex items-center justify-center w-16 h-16 text-white bg-blue-600 text-sm font-medium rounded-l-md">
                                No
                            </div>
                            <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                <div class="flex-1 px-4 py-2 text-sm truncate">
                                    <p class="text-gray-900 font-medium hover:text-gray-600">images</p>
                                    <p class="text-gray-500">analytics</p>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </x-slot>
        </x-card>
    </div>
    @endcan

    <ul role="list" class="space-y-12 {{ (Auth::check()) ? 'pt-8' : 'pt-4' }} sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">
        @if (!$photos->isEmpty())
          @foreach($photos as $photo)
              @if($photo->visible)
        <li>
          <div class="space-y-4" x-data="{ open: false }" @mouseleave="open = false" >
            <div class="aspect-w-3 aspect-h-2 relative w-full" @mouseover="open = true" @if(!Auth::check()) wire:click="$emit('openModal', 'photo.view-photo', {{ json_encode(['photo_id' => $photo->id, 'gallery_id' => $gallery->id, 'page_module' => $page_module]) }})" @endif>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90" class="flex flex-col content-center justify-center m-auto absolute inset-0 mr-2">
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" modal="photo.view-photo" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module, 'gallery_id' => $gallery->id]" button_text="view" :page_module="$page_module" />
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" :modal="$page_module->module->edit_component" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" :page_module="$page_module" />
                    <livewire:core.card-footer :duration="$updated_at" :show_timestamp="false" modal="photo.remove.remove-grid-photo" :modal_parameters="['photo_id' => $photo->id, 'page_module' => $page_module]" button_text="remove" :page_module="$page_module" />
                </div>
                <img class="object-cover shadow-lg rounded-lg" src="{{ $photo->image->file }}" alt="">
                @if (!$user_reactions->isEmpty() && $allow_reactions)
                    <div  class="flex flex-col content-start justify-start m-auto absolute h-1 inset-0 mt-2 ml-2 mr-2">
                        <div class="grid grid-cols-10 grid-end-7">
                            @foreach($user_reactions->where('gallery_image_id', $photo->id)->take(10) as $reaction)
                                <div class="col-span-1">
                                    <span class="inline-flex items-center p-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $reaction->reaction->icon }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-2">
              <ul role="list" class="flex space-x-5">
                <li>
                  <livewire:core.footer-metadata :duration="$updated_at" :page_module="$page_module" />
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
