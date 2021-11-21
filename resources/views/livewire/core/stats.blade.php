<div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">
        {{ $header }}
    </h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 {{ ($page_module->enabled) ? '' : 'border-dashed border-4 rounded-xl' }}">
        @if (!$cards->isEmpty())
            @foreach($cards as $card)
        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
            <dt class="text-sm font-medium text-gray-500 truncate">
                {{ $card['item'] }}
            </dt>
            <dd class="mt-1 text-3xl font-semibold text-gray-900">

                {{ (is_int($card['number'])) ? number_format($card['number'], 0, '.', ',') : number_format($card['number'], 2, '.', ',') }}{{ ($card['percentage']) ? '%' : '' }}
            </dd>
        </div>
            @endforeach
        @endif
    </dl>

    @if (Auth::check())
        <div class="m-4 pb-2">
            <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['header' => $header, 'cards' => $cards, 'page_module' => $page_module]" />
        </div>
    @endif
</div>
