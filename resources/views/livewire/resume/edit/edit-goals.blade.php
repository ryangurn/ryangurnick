<div x-data>
    <div class="pt-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
        <label for="card body" class="sr-only">card body</label>
        <textarea rows="10" name="card body" id="card body" class="block dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 w-full border-0 pt-2.5 p-3 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a body..." wire:model="body"></textarea>

        <div aria-hidden="true">
            <div class="h-px"></div>
            <div class="py-2">
                <div class="py-px">
                    <div class="h-9"></div>
                </div>
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
                    @error('body') <li class="text-red-800">{{ $message }}</li> @enderror
                </ul>
            </div>
        </div>
    </div>
</div>
