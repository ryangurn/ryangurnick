<div class="p-2" x-data
     @keydown.window.prevent.ctrl.a="$wire.add()"
     @keydown.window.prevent.cmd.a="$wire.add()">
    @if (!$institutions->isEmpty())
        @foreach($institutions as $key => $institution)
            <div class="grid grid-cols-6 gap-6">

                @if ($key != 0)
                    <div class="col-span-6 mt-2 mb-2">
                        <hr />
                    </div>
                @endif

                <div class="col-span-5">
                    <fieldset class="bg-white dark:bg-gray-900">
                        <legend class="block text-sm font-medium text-gray-700 dark:text-gray-400">education #{{ $key+1 }}</legend>
                        <div class="mt-1 rounded-md shadow-sm -space-y-px">
                            <div>
                                <label for="country" class="sr-only dark:text-gray-400">organization #{{ $key+1 }}</label>
                                <input type="text" class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none rounded-t-md bg-transparent focus:z-10 sm:text-sm border-gray-300" placeholder="organization #{{ $key+1 }}" wire:model="institutions.{{ $key }}.organization">
                            </div>
                            <div>
                                <label for="postal-code" class="sr-only dark:text-gray-400">duration #{{ $key+1 }}</label>
                                <input type="text" class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none bg-transparent focus:z-10 sm:text-sm border-gray-300" placeholder="duration #{{ $key+1 }}" wire:model="institutions.{{ $key }}.duration">
                            </div>
                            <div>
                                <label for="postal-code" class="sr-only dark:text-gray-400">description #{{ $key+1 }}</label>
                                <textarea class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 focus:ring-indigo-500 focus:border-indigo-500 relative p-3 block w-full rounded-none rounded-b-md bg-transparent focus:z-10 sm:text-sm border-gray-300" placeholder="description #{{ $key+1 }}" wire:model="institutions.{{ $key }}.body"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-span-1">
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
        <div class="border-t border-gray-200 dark:border-gray-700 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
            <div class="flex-shrink-0">
                <button @keydown.window.prevent.ctrl.s="$wire.save()"
                        @keydown.window.prevent.cmd.s="$wire.save()"
                        type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click="save">
                    Save
                </button>
            </div>
            <div>
                <ul class="list-disc">
                    @if (!$institutions->isEmpty())
                        @foreach($institutions as $key => $institution)
                            @error('institutions.'.$key.'.duration') <li class="text-red-800">{{ $message }}</li> @enderror
                            @error('institutions.'.$key.'.location') <li class="text-red-800">{{ $message }}</li> @enderror
                            @error('institutions.'.$key.'.organization') <li class="text-red-800">{{ $message }}</li> @enderror
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>
