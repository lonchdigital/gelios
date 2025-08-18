{{-- resources/views/search/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    @if (!app()->environment('production'))
        <meta name="robots" content="noindex, nofollow">
    @endif
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL') }}">
    <meta name="app-locale" content="{{ app()->getLocale() }}">
    <link rel="icon" href="{{ asset('/static_images/cropped-favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('/static_images/cropped-favicon-192x192.png') }}" type="image/png" sizes="192x192">

    @vite(['resources/js/app.js'])

    <style>
      /* ====== локальная стилизация результата (изолирована по .sres) ====== */
      .sres{padding:24px 0 56px}
      .sres__head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;margin-bottom:16px}
      .sres__title{margin:0;font-weight:800;line-height:1.25}
      .sres__bar{display:flex;gap:10px;align-items:center}
      .sres__bar .form-control{height:44px;border-radius:999px;padding:0 16px}
      .sres__bar .btn{height:44px;border-radius:999px;padding:0 18px}

      .sres__section{background:#fff;border:1px solid #E6EEF7;border-radius:16px;padding:18px;margin-bottom:18px;
                     box-shadow:0 6px 18px rgba(44,84,118,.08)}
      .sres__section-title{display:flex;align-items:center;gap:10px;margin:0 0 10px 0;font-weight:800}
      .sres__section-title svg{width:18px;height:18px;opacity:.7}

      .sres__list{list-style:none;margin:0;padding:0;display:grid;grid-template-columns:1fr;gap:6px}
      .sres__item{}
      .sres__link{display:block;padding:10px 12px;border-radius:12px;text-decoration:none;color:#0F1F2E}
      .sres__link:hover{background:#F5FAFF}
      .sres__title-sm{font-weight:700;line-height:1.25}
      .sres__sub{font-size:13px;color:#6B7C8C;margin-top:2px}
      .sres__price{font-size:13px;color:#0F1F2E;font-weight:700;margin-top:2px}

      .sres__more{margin-top:10px}
      .sres__more .btn{border-radius:999px}

      @media (min-width:576px){ .sres__list{grid-template-columns:repeat(2,1fr)} }
      @media (min-width:992px){ .sres__list{grid-template-columns:repeat(3,1fr)} }
    </style>
</head>
<body>
  <div class="wrapper">
    <div class="popup-bg-body" data-toggle="collapse" data-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation"></div>

    @include('site.parts.header')

    @php
      $sprite = Vite::asset(config('app.icons_path'));
      $qSafe  = (string)($q ?? '');
      $uah    = __('ui.common.currency.uah'); // добавьте ключ в языковые файлы
    @endphp

    <main>
      <div class="container sres">

        <div class="sres__head">
          <h1 class="sres__title h2 mb-0">{{ __('ui.search.results.title') }}</h1>

         
        </div>

        {{-- ===== DOCTORS ===== --}}
        @if(!empty($groups['doctors']))
          <section class="sres__section">
            <h2 class="sres__section-title h4 mb-2">
              <svg aria-hidden="true"><use xlink:href="{{ $sprite }}#i-user"></use></svg>
              {{ __('ui.search.sections.doctors') }}
            </h2>

            <ul class="sres__list">
              @foreach($groups['doctors'] as $item)
                <li class="sres__item">
                  <a class="sres__link" href="{{ $item['url'] }}">
                    <div class="sres__title-sm">{{ $item['title'] }}</div>
                    @if(!empty($item['subtitle']))
                      <div class="sres__sub">{{ $item['subtitle'] }}</div>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>

            @if(Route::has('doctors.index'))
              <div class="sres__more">
                <a class="btn btn-outline-primary btn-sm"
                   href="{{ route('doctors.index', ['q'=>$qSafe, 'search'=>$qSafe]) }}">
                  {{ __('ui.search.more.doctors') }}
                </a>
              </div>
            @endif
          </section>
        @endif

        {{-- ===== SERVICES / DIRECTIONS ===== --}}
        @if(!empty($groups['services']))
          <section class="sres__section">
            <h2 class="sres__section-title h4 mb-2">
              <svg aria-hidden="true"><use xlink:href="{{ $sprite }}#i-list"></use></svg>
              {{ __('ui.search.sections.services') }}
            </h2>

            <ul class="sres__list">
              @foreach($groups['services'] as $item)
                <li class="sres__item">
                  <a class="sres__link" href="{{ $item['url'] }}">
                    <div class="sres__title-sm">{{ $item['title'] }}</div>
                    @if(!empty($item['subtitle']))
                      <div class="sres__sub">{{ $item['subtitle'] }}</div>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>

            <div class="sres__more">
              @if(Route::has('directions.page'))
                <a class="btn btn-outline-primary btn-sm" href="{{ route('directions.page') }}">
                  {{ __('ui.search.more.services') }}
                </a>
              @elseif(Route::has('services.index'))
                <a class="btn btn-outline-primary btn-sm" href="{{ route('services.index', ['q'=>$qSafe]) }}">
                  {{ __('ui.search.more.services') }}
                </a>
              @endif
            </div>
          </section>
        @endif

        {{-- ===== ARTICLES ===== --}}
        @if(!empty($groups['articles']))
          <section class="sres__section">
            <h2 class="sres__section-title h4 mb-2">
              <svg aria-hidden="true"><use xlink:href="{{ $sprite }}#i-article"></use></svg>
              {{ __('ui.search.sections.articles') }}
            </h2>

            <ul class="sres__list">
              @foreach($groups['articles'] as $item)
                <li class="sres__item">
                  <a class="sres__link" href="{{ $item['url'] }}">
                    <div class="sres__title-sm">{{ $item['title'] }}</div>
                    @if(!empty($item['subtitle']))
                      <div class="sres__sub">{{ $item['subtitle'] }}</div>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>

            @if(Route::has('articles.index'))
              <div class="sres__more">
                <a class="btn btn-outline-primary btn-sm" href="{{ route('articles.index', ['q'=>$qSafe]) }}">
                  {{ __('ui.search.more.articles') }}
                </a>
              </div>
            @endif
          </section>
        @endif

        {{-- ===== PRICES ===== --}}
        @if(!empty($groups['prices']))
          <section class="sres__section">
            <h2 class="sres__section-title h4 mb-2">
              <svg aria-hidden="true"><use xlink:href="{{ $sprite }}#i-price"></use></svg>
              {{ __('ui.search.sections.prices') }}
            </h2>

            <ul class="sres__list">
              @foreach($groups['prices'] as $item)
                <li class="sres__item">
                  <a class="sres__link" href="{{ $item['url'] }}">
                    <div class="sres__title-sm">{{ $item['title'] }}</div>

                    {{-- приоритет: subtitle (у контроллера уже лежит "№… · 1 500 ₴"); 
                       если его нет, но есть числовая цена — форматируем здесь --}}
                    @if(!empty($item['subtitle']))
                      <div class="sres__sub">{{ $item['subtitle'] }}</div>
                    @elseif(isset($item['price']))
                      <div class="sres__price">
                        {{ number_format((float)$item['price'], 0, '.', ' ') }} {{ $uah }}
                      </div>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>

            <div class="sres__more">
              @if(Route::has('prices.page'))
                <a class="btn btn-outline-primary btn-sm" href="{{ route('prices.page') }}">
                  {{ __('ui.search.more.prices') }}
                </a>
              @elseif(Route::has('prices.index'))
                <a class="btn btn-outline-primary btn-sm" href="{{ route('prices.index', ['q'=>$qSafe]) }}">
                  {{ __('ui.search.more.prices') }}
                </a>
              @endif
            </div>
          </section>
        @endif

      </div>
    </main>

    @include('site.parts.footer')

    <div id="btnTop" class="btn btn-arrow-up">
      <svg><use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-small-down' }}"></use></svg>
    </div>
  </div>

  @vite(['resources/js/main.js'])
</body>
</html>
