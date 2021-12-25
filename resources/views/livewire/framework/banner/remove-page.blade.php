<div x-data>
    <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
        <label for="name" class="sr-only">page</label>
        <select class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Page" wire:model="page">
            @if (!$pages->isEmpty())
                @foreach($pages as $page)
                    <option value="{{ $page->id }}">{{ $page->name }}</option>
                @endforeach
            @endif
        </select>

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
                <button @keydown.window.prevent.ctrl.s="$wire.save()"
                        @keydown.window.prevent.cmd.s="$wire.save()"
                        type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        wire:click="save">
                    Remove Page
                </button>
            </div>
            <div>
                <ul class="list-disc">
                    @error('page') <li class="text-red-800">{{ $message }}</li> @enderror
                </ul>
            </div>
        </div>
    </div>
</div>
