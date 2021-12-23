@if (!$menu->isEmpty())
    @foreach($menu as $menu)
        @if ($menu->enabled && $menu->page != null)
            <li><a href="{{ route($menu->page->name) }}" class="border-b-4 pb-3 border-solid {{ (Route::currentRouteName() == $menu->page->name) ? 'border-blue' : 'text-gray-400 hover:border-blue' }}">{{ $menu->page->title }}</a></li>
        @endif
    @endforeach
@endif
