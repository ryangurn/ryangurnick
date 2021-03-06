<div class="relative">
    <div class="relative hover:shadow-xl rounded-2xl sm:overflow-hidden">
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover rounded-2xl" src="{{ $image }}" alt="People working on laptops">
            <div class="absolute inset-0 bg-indigo-700 mix-blend-multiply rounded-2xl"></div>
        </div>
        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8 {{ ($page_module->enabled) ? '' : 'border-dashed border-4' }}">
            <h1 class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                <span class="block text-white">{{ $header }}</span>
            </h1>
            <p class="mt-6 max-w-lg mx-auto text-center text-xl text-indigo-200 sm:max-w-3xl">
                {{ $body }}
            </p>
            <div class="mt-10 max-w-sm mx-auto sm:max-w-none flex justify-center gap-2">
                @if(!$links->isEmpty())
                    @foreach($links as $link)
                        @if ($link['link'] != "" && $link['value'] != "")
                <a href="{{ $link['link'] }}" class="px-4 md:px-2 py-3 md:py-1 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-500 bg-opacity-60 hover:bg-opacity-70 sm:px-8">
                    {{ $link['value'] }}
                </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 p-4">
        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['header' => $header, 'body' => $body, 'links' => $links, 'page_module' => $page_module]" />
    </div>
</div>
