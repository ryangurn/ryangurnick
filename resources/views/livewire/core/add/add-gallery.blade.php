<div class="p-2" x-data>
    <div class="grid grid-cols-6 gap-6">
        @if (!$new)
        <div class="col-span-6">
            <label for="quote" class="block text-sm font-medium text-gray-700 dark:text-gray-400">name</label>
            <input type="text" name="quote" class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="name">
        </div>

        <div class="col-span-6">
            <label for="region" class="block text-sm font-medium text-gray-700 dark:text-gray-400">description</label>
            <textarea type="text" name="quote" class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 p-3 mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="description"></textarea>
        </div>
        @else
        <div class="col-span-6">
            <label for="region" class="block text-sm font-medium text-gray-700 dark:text-gray-400">description</label>
            <select class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 p-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:model="gallery_id" >
                <option>select a gallery</option>
                @foreach($galleries as $gallery)
                    <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="col-span-6">
            @if (!$new)
                @if (!$galleries->isEmpty())
                <a wire:click="$toggle('new')" class="hover:underline dark:text-white">use old gallery.</a>
                @endif
            @else
                <a wire:click="$toggle('new')" class="hover:underline dark:text-white">create a new gallery.</a>
            @endif
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
                    @error('name') <li class="text-red-800">{{ $message }}</li> @enderror
                    @error('description') <li class="text-red-800">{{ $message }}</li> @enderror
                    @error('gallery_id') <li class="text-red-800">{{ $message }}</li> @enderror
                </ul>
            </div>
        </div>
    </div>

</div>
