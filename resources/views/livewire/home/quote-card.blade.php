<x-card :pm="$page_module">
    <x-slot name="title">quote</x-slot>
    <x-slot name="body">

        <div class="text-gray-600 mt-3">
            <ul class="text-lg ml-4">
                @if (!$quotes->isEmpty())
                    @foreach ($quotes as $quote)
                        <li class="pb-4"><span class="border-b-4 pb-3 border-solid transition duration-150 ease-in border-b-4 pb-3 hover:border-red">{{ $quote['quote'] }} @if($quote['author'] != null)<span class="text-sm">-{{ $quote['author'] }}</span>@endif<span></li>
                    @endforeach
                @endif
            </ul>
        </div>

        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" modal="home.edit-quote" :modal_parameters="['quotes' => $quotes, 'page_module' => $page_module]" />

    </x-slot>
</x-card>
