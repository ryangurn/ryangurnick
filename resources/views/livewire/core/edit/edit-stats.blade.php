<div class="p-2" x-data>
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-3">
            <label for="quote" class="block text-sm font-medium text-gray-700">header</label>
            <input type="text" name="quote" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="header">
        </div>
        <div class="col-span-6 pt-0.5">
            <hr />
        </div>
    </div>
    @if (!$cards->isEmpty())
        @foreach($cards as $key => $card)
            <div class="grid grid-cols-6 gap-6">

                @if ($key != 0)
                    <div class="col-span-6 pt-2">
                        <hr />
                    </div>
                @endif

                <div class="col-span-3">
                    <label for="quote" class="block text-sm font-medium text-gray-700">item #{{ $key+1 }}</label>
                    <input type="text" name="quote" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="cards.{{ $key }}.item">
                </div>

                <div class="col-span-3">
                    <label for="region" class="block text-sm font-medium text-gray-700">number #{{ $key+1 }}</label>
                    <input type="text" name="quote" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="cards.{{ $key }}.number">
                </div>

                <div class="col-span-3">
                    <label for="region" class="block text-sm font-medium text-gray-700">percentage #{{ $key+1 }}</label>
                    <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="cards.{{ $key }}.percentage">
                        <option value="1">true</option>
                        <option value="0">false</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="region" class="block text-sm font-medium text-gray-700 mt-1">&nbsp;</label>
                    <button type="submit" class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="remove({{ $key }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button type="submit" class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="add">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    @endif

    <div aria-hidden="true">
        <div class="h-px"></div>
        <div class="py-2">
            <div class="py-px">
                <div class="h-12"></div>
                @for($i = count($errors->all())-2; $i > 0; $i-- )
                    <div class="h-5"></div>
                @endfor
            </div>
        </div>
    </div>


    <div class="absolute bottom-0 inset-x-px">
        <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
            <div class="flex-shrink-0">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save" @keydown.window.prevent.ctrl.s="$wire.save()" @keydown.window.prevent.cmd.s="$wire.save()">
                    Save
                </button>
            </div>
            <div>
                <ul class="list-disc">
                    @error('header') <li class="text-red-800">{{ $message }}</li> @enderror
                    @if (!$cards->isEmpty())
                        @foreach($cards as $key => $card)
                            @error('cards.'.$key.'.item') <li class="text-red-800">{{ $message }}</li> @enderror
                            @error('cards.'.$key.'.number') <li class="text-red-800">{{ $message }}</li> @enderror
                            @error('cards.'.$key.'.percentage') <li class="text-red-800">{{ $message }}</li> @enderror
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>
