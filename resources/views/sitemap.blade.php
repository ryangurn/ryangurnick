<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if (!$pages->isEmpty())
        @foreach($pages as $page)
            @if ($page->name != "post")
    <url>
        <loc>{{ route($page->name) }}</loc>
        <lastmod>{{ $page->updated_at->isoFormat('YYYY-MM-DD') }}</lastmod>
    </url>
            @elseif (!$posts->isEmpty())
                @foreach ($posts as $post)
                    @if ($post->page != null)
    <url>
        <loc>{{ route($page->name, $post->hash) }}</loc>
        <lastmod>{{ $post->updated_at->isoFormat('YYYY-MM-DD') }}</lastmod>
    </url>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
</urlset>
