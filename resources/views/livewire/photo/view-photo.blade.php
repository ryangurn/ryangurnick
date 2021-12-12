<div class="bg-transparent">
    <img class="object-cover shadow-lg rounded-lg" src="{{ $photo->image->file }}">
    <div class="m-2 bg-transparent">
        <div class="flex">
            @if (isset($photo->location) && $photo->location != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ $photo->location }}
                </span>
            @endif
            @if (isset($photo->date) && $photo->date != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 {{ (isset($photo->location) && $photo->location != null) ? 'ml-2' : '' }}">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ Carbon\Carbon::parse($photo->date)->diffForHumans() }}
                </span>
            @endif
        </div>
        <div class="text-lg leading-6 font-medium space-y-1">
            <p>
                {{ $photo->caption }}
            </p>
            @auth
                @if ($allow_reactions)
            <div class="grid grid-cols-10 gap-2 mt-4 mb-4" x-data="{ show_reactions: false }">
                <button type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="show_reactions = !show_reactions">
                    react
                </button>

                @if (!$reactions->isEmpty())
                    @foreach($reactions as $reaction)
                    <div class="col-span-1 cursor-pointer" x-show="show_reactions">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800" wire:click="react({{$reaction->id}})">
                        {{ $reaction->icon }}
                        </span>
                    </div>
                    @endforeach
                @endif
            </div>
                @endif
            @endauth
        </div>
    </div>
</div>
