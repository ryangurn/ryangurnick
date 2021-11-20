<x-card :pm="$page_module">
    <x-slot name="title">{{ $header }}</x-slot>
    <x-slot name="body">
            <div class="relative max-w-xl mx-auto">
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    @if (session()->has('message'))
                    <div class="sm:col-span-2">
                        <div class="rounded-md bg-green-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/check-circle -->
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm text-green-700">
                                        <p>
                                            {{ session('message') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div>
                        <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                        <div class="mt-1">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-3 px-4 block w-full shadow-sm rounded-md {{ ($errors->first('contact.first_name') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }}" wire:model="contact.first_name">
                            @error('contact.first_name') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                        <div class="mt-1">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-3 px-4 block w-full shadow-sm {{ ($errors->first('contact.last_name') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }} rounded-md" wire:model="contact.last_name">
                            @error('contact.last_name') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                        <div class="mt-1">
                            <input type="text" name="company" id="company" autocomplete="organization" class="py-3 px-4 block w-full shadow-sm {{ ($errors->first('contact.company') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }} rounded-md" wire:model="contact.company">
                            @error('contact.company') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm {{ ($errors->first('contact.company') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }} rounded-md" wire:model="contact.email">
                            @error('contact.email') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="phone-number" id="phone-number" autocomplete="tel" class="py-3 px-4 block w-full {{ ($errors->first('contact.company') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }} rounded-md" placeholder="+1 (555) 987-6543" wire:model="contact.phone_number">
                            @error('contact.phone_number') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm {{ ($errors->first('contact.company') == null) ? 'focus:ring-indigo-500 focus:border-indigo-500 border-gray-300' : 'focus:ring-red-500 focus:border-red-500 border-red-300' }} rounded-md" wire:model="contact.message"></textarea>
                            @error('contact.message') <span class="text-red-800">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="send">
                            Let's talk
                        </button>
                    </div>
                </div>
            </div>

            <livewire:core.card-footer :page_module="$page_module" :modal="$page_module->module->edit_component" :modal_parameters="['page_module' => $page_module, 'header' => $header]" :duration="$updated_at"  />
    </x-slot>
</x-card>
