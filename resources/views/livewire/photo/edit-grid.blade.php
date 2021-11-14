<div>
    <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
        <label for="name" class="sr-only">location</label>
        <input type="text" name="name" id="name" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="location" wire:model="photo.location">
        <label for="name" class="sr-only">date</label>
        <input type="text" name="name" id="name" class="block w-full border-0 pt-0.5 text-md font-medium placeholder-gray-500 focus:ring-0" placeholder="date" wire:model="photo.date">
        <label for="card body" class="sr-only">photo body</label>
        <textarea rows="10" name="card body" id="card body" class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="body" wire:model="photo.description"></textarea>

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
        <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
            <div class="flex-shrink-0">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save">
                    Save
                </button>
            </div>
            <div class="flex-grow">
                <input id="image" wire:model="image" type='file' hidden/>
                <button type="button" class="rounded-full inline-flex text-left text-gray-400 group" id="image-click">
                    <!-- Heroicon name: solid/paper-clip -->
                    <svg class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-gray-500 group-hover:text-gray-600 italic">Attach a file</span>
                </button>
                <script type="text/javascript">
                    document.getElementById('image-click').addEventListener('click', function() {
                        document.getElementById('image').click();
                    });

                </script>
            </div>
            <div>
                <ul class="list-disc">
                    @error('photo.description') <li class="text-red-800">{{ $message }}</li> @enderror
                    @error('photo.location') <li class="text-red-800">{{ $message }}</li> @enderror
                    @error('photo.date') <li class="text-red-800">{{ $message }}</li> @enderror
                    @error('image') <li class="text-red-800">{{ $message }}</li> @enderror
                </ul>
            </div>
        </div>
    </div>
</div>
