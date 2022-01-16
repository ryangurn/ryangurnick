<div class="pl-4 pr-4">
    @if ($auth_required && $auth)
    <div class="flex items-center justify-{{ ($show_timestamp) ? 'between' : 'center'}} mt-6">
        @if ($show_timestamp)
            <livewire:core.footer-metadata :duration="$duration" />
        @endif
        <div class="flex items-center space-x-2" x-init="$wire.show">
            @if ($modal != null && ((auth()->user()->can($page_module->module->permissions['edit']) && $button_text == "edit")
                                    || (auth()->user()->can('add photo') && $button_text == "add photo")
                                    || (auth()->user()->can('delete photo') && $button_text == "remove"))
                                    || ($button_text == "view"))
                <div class="bg-gray-100 dark:bg-gray-400 hover:bg-gray-200 dark:hover:bg-gray-500 dark:text-white text-xxs font-bold leading-none rounded-full text-center w-28 h-7 py-2 px-4" wire:click="$emit('openModal', '{{ $modal }}', {{ json_encode($modal_parameters) }})">
                    {{ $button_text }}
                </div>
            @endif
            @if (($show_menu || $page_module->module->name != "Photo Grid") && auth()->user()->canAny([$page_module->module->permissions['edit'], $page_module->module->permissions['delete'], $page_module->module->permissions['reorder']]))
                <button wire:click="$toggle('show')" x-data="{ hide(){ $wire.hidePopup() }, show() { $wire.showPopup() } }" x-on:click.away="hide()" x-on:mouseover.debounce="show()" class="relative bg-gray-100 dark:bg-gray-400 hover:bg-gray-200 dark:hover:bg-gray-500 dark:text-white rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                    <ul x-on:mouseleave.debounce="hide()" class="{{ ($show) ? '' : 'hidden' }} absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-1 px-1 md:ml-8 top-12 md:top-6 right-0 md:left-0 shadow-sm hover:shadow-md z-4 border border-gray-200 dark:border-gray-500 dark:bg-gray-500">
                        @if ($page_module->enabled && auth()->user()->can($page_module->module->permissions['edit']))
                            <li><a wire:click="disable" class="hover:bg-gray-100 dark:hover:bg-gray-400 rounded-xl block transition duration-150 ease-in px-5 py-3">disable card</a></li>
                        @elseif (!$page_module->enabled && auth()->user()->can($page_module->module->permissions['edit']))
                            <li><a wire:click="enable" class="hover:bg-gray-100 dark:hover:bg-gray-400 rounded-xl block transition duration-150 ease-in px-5 py-3">enable card</a></li>
                        @endif
                        @if (auth()->user()->can($page_module->module->permissions['delete']))
                            <li><a wire:click="delete" class="hover:bg-red-100 dark:hover:bg-red-400 rounded-xl block transition duration-150 ease-in px-5 py-3">delete card</a></li>
                        @endif
                        @if (auth()->user()->can($page_module->module->permissions['reorder']))
                            <li><a wire:click="$emit('openModal', 'core.change-order', {{ json_encode(['page_module' => $page_module]) }})" class="hover:bg-gray-100 dark:hover:bg-gray-400 rounded-xl block transition duration-150 ease-in px-5 py-3">change order</a></li>
                        @endif

                        @if (count($menu_options) > 0 && auth()->user()->can($page_module->module->permissions['edit']))
                            @foreach($menu_options as $option)
                                <li><a @isset($option['link']) href="{{ $option['link'] }}" @endisset @isset($option['modal'], $option['parameters']) wire:click="$emit('openModal', '{{ $option['modal'] }}', {{ json_encode($option['parameters']) }})" @endisset class="hover:bg-gray-100 dark:hover:bg-gray-400 rounded-xl block transition duration-150 ease-in px-5 py-3">{{ $option['value'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </button>
            @endif
        </div>
    </div>
    @endif
</div>
