@if (\App\Models\Setting::where('key', '=', 'application.logo')->first() != null && \App\Models\Image::where('id', '=', \App\Models\Setting::where('key', '=', 'application.logo')->first()->value)->first() != null)
<img src="{{ \App\Models\Image::where('id', '=', \App\Models\Setting::where('key', '=', 'application.logo')->first()->value)->first()->file }}" alt="avatar" {{ $attributes->class('mr-2 rounded-full') }} />
@elseif (count(explode(" ", \App\Models\Setting::where('key', '=', 'application.sitename')->first()->value)) >= 2)
    <div class="text-3xl font-bold rounded-full border border-gray-400 p-2 mr-2">
        {{ substr(explode(" ", \App\Models\Setting::where('key', '=', 'application.sitename')->first()->value)[0], 0, 1).' '.substr(explode(" ", \App\Models\Setting::where('key', '=', 'application.sitename')->first()->value)[1], 0, 1) }}
    </div>
@else
    <div></div>
@endif
