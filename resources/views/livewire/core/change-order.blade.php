<div class="p-2" x-data>
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-3">
            <label for="quote" class="block text-sm font-medium text-gray-700 dark:text-gray-400">order </label>
            <input type="text" name="quote" class="mt-1 block dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 dark:border-gray-700 w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="page_module.order">
        </div>
    </div>

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
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save" @keydown.window.prevent.ctrl.s="$wire.save()" @keydown.window.prevent.cmd.s="$wire.save()">
                    Save
                </button>
            </div>
            <div>
                <ul class="list-disc">
                    @error('page_module.order') <li class="text-red-800">{{ $message }}</li> @enderror
                </ul>
            </div>
        </div>
    </div>

</div>
