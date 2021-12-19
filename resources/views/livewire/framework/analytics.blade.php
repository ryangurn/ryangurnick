@can('view site analytics')
<div>
    <dl class="grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-x divide-gray-200 md:grid-cols-3 md:divide-y md:divide-x">
        @if (!$pages->isEmpty())
            @foreach ($pages as $page)
        <div class="px-4 py-5 sm:p-6">
            <dt class="text-base font-normal text-gray-900">
                {{ $page->title }}
            </dt>
            <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                    {{ $page->statistic_views()->count() }}
                    <span class="ml-2 text-sm font-medium text-gray-500">
                        unique views today
                    </span>
                </div>

                <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                    total views {{ $page->statistic_views()->sum('count') }}
                </div>
            </dd>
        </div>
            @endforeach
                @if ($pages->count() % 3 != 0)
                    @for ($i=$pages->count(); ($i % 3 != 0); $i++ )
                        <div class="px-4 py-5 sm:p-6"></div>
                    @endfor
                @endif
        @endif
    </dl>
</div>
@endcan
