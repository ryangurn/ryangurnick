<div>
    @if ($auth_required && $auth)
    <div class="flex items-center justify-{{ ($show_timestamp) ? 'between' : 'center'}} mt-6">
        @if ($show_timestamp)
            <livewire:core.footer-metadata :duration="$duration" />
        @endif
        <div class="flex items-center space-x-2" x-init="$wire.show">
            @if ($modal != null)
                <div class="bg-gray-100 hover:bg-gray-200 text-xxs font-bold leading-none rounded-full text-center w-28 h-7 py-2 px-4" wire:click="$emit('openModal', '{{ $modal }}', {{ json_encode($modal_parameters) }})">
                    {{ $button_text }}
                </div>
            @endif
            @if ($show_menu || $page_module != null)
                <button wire:click="$toggle('show')" x-data="{ hide(){ $wire.hidePopup() }, show() { $wire.showPopup() } }" x-on:click.away="hide()" x-on:mouseover.debounce="show()" class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                    <ul x-on:mouseleave.debounce="hide()" class="{{ ($show) ? '' : 'hidden' }} absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-1 px-1 ml-8 shadow-sm hover:shadow-md">
                        @if ($page_module->enabled)
                            <li><a wire:click="disable" class="hover:bg-gray-100 rounded-xl block transition duration-150 ease-in px-5 py-3">disable card</a></li>
                        @elseif (!$page_module->enabled)
                            <li><a wire:click="enable" class="hover:bg-gray-100 rounded-xl block transition duration-150 ease-in px-5 py-3">enable card</a></li>
                        @endif
                        <li><a wire:click="$emit('openModal', 'core.change-order', {{ json_encode(['page_module' => $page_module]) }})" class="hover:bg-gray-100 rounded-xl block transition duration-150 ease-in px-5 py-3">change order</a></li>

                        @if (count($menu_options) > 0)
                            @foreach($menu_options as $option)
                                <li><a href="{{ $option['link'] }}" class="hover:bg-gray-100 rounded-xl block transition duration-150 ease-in px-5 py-3">{{ $option['value'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </button>
            @endif
        </div>
    </div>
    @endif
</div>
