<title>{{ $title ?? config('app.name')}}</title>
<meta property="og:title" content="{{ $title ?? config('app.name') }}"/>
<meta property="og:image" content="{{ $image ?? asset('static_images/logo.svg') }}"/>

<meta property="twitter:title" content="{{ $title ?? config('app.name') }}"/>

@if (!empty($page->meta_description) || !empty($description))
    <meta name="description" content="{{ strip_tags($description) ?? strip_tags($page->meta_description) }}">
    <meta property="og:description" content="{{ strip_tags($description) ?? strip_tags($page->meta_description) }}"/>
    <meta property="twitter:description" content="{{ strip_tags($description) ?? strip_tags($page->meta_description) }}"/>
@endif

@if(isset($url['uk']) && isset($url['ru']))
    <link rel="canonical" href="{{ $url[app()->getLocale()] }}">
    <meta property="og:url" content="{{ $url[app()->getLocale()] }}"/>

    {{-- <link rel="alternate" href="{{ $url['uk'] }}" hreflang="uk-UA">
    <link rel="alternate" href="{{ $url['ru'] }}" hreflang="ru-UA">
    <link rel="alternate" href="{{ $url['uk'] }}" hreflang="x-default">
    <link rel="alternate" href="{{ $url['en'] }}" hreflang="en-UA"> --}}
@endif
