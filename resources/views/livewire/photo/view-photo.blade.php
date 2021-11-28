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
            <p>{{ $photo->caption }}</p>
        </div>
    </div>
</div>
