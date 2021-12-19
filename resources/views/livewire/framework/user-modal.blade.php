<div class="shadow sm:rounded-md sm:overflow-hidden" x-data>
    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">account management</h3>
        </div>

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <label for="first-name" class="block text-sm font-medium text-gray-700">name</label>
                <input type="text" autocomplete="given-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="user.name">
            </div>

            <div class="col-span-6 sm:col-span-6">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="text" autocomplete="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="user.email">
            </div>

            <div class="col-span-6 sm:col-span-6">
                <label for="country" class="block text-sm font-medium text-gray-700">roles</label>
                <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple wire:model="role">
                    @if(!$roles->isEmpty())
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ strtolower($role->name) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="save" @keydown.window.prevent.ctrl.s="$wire.save()"
                @keydown.window.prevent.cmd.s="$wire.save()">
            Save
        </button>
    </div>
</div>
