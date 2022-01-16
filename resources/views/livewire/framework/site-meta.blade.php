<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@if (isset($indexing))
<meta name="robots" content="{{ $indexing }}" />
<meta name="googlebot" content="{{ $indexing }}" />
@endif
