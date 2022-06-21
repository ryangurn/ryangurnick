@if (!$menu->isEmpty())
    @foreach($menu as $menu)
        @if ($menu->enabled && $menu->page != null)
            <li><a href="{{ route($menu->page->name) }}" class="border-b-4 pb-3 border-solid {{ (Route::currentRouteName() == $menu->page->name) ? 'border-blue text-black dark:text-white' : 'text-gray-500 hover:border-blue dark:border-gray-700' }}">{{ $menu->page->title }}</a></li>
        @endif
    @endforeach
@endif
