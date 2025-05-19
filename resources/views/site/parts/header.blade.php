<header class="header">
    <div class="header-top d-none d-lg-block w-100">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="inner d-flex justify-content-between align-items-center py-2">
                        <ul class="list-inline mb-0 d-none d-xxl-flex align-items-center">
                            <li class="list-inline-item">
                                <div class="city">{{ $firstCity->title ?? '' }}</div>
                            </li>
                            @if(!empty($firstCity->first_phone))
                                <li class="list-inline-item">
                                    <a href="tel:{{ $firstCity->first_phone ?? '' }}">
                                        <div class="link-phone">{{ $firstCity->first_phone ?? '' }}</div>
                                    </a>
                                </li>
                            @endif
                            @if(!empty($firstCity->second_phone))
                                <li class="list-inline-item">
                                    <a href="tel:{{ $firstCity->second_phone ?? '' }}">
                                        <div class="link-phone">{{ $firstCity->second_phone ?? '' }}</div>
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item">
                                <button type="button" class="contact-details" data-toggle="modal"
                                        data-target="#popup--contacts"
                                        data-city="{{ $firstCity->title ?? '' }}"
                                        data-affiliates="{{ $firstCity->headerAffiliates }}">
                                    {{ __('pages.view') }}
                                </button>
                            </li>
                        </ul>
                        <ul class="list-inline mb-0 d-none d-xxl-flex align-items-center mr-xxl-2">
                            <li class="list-inline-item">
                                <div class="city">{{ $secondCity->title ?? '' }}</div>
                            </li>
                            @if(!empty($secondCity->first_phone))
                                <li class="list-inline-item">
                                    <a href="tel:{{ $secondCity->first_phone ?? '' }}">
                                        <div class="link-phone">{{ $secondCity->first_phone ?? '' }}</div>
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item">
                                <button type="button" class="contact-details" data-toggle="modal" data-city="{{ $secondCity->title ?? '' }}"
                                    data-affiliates="{{ $secondCity->headerAffiliates }}"
                                    data-target="#popup--contacts">{{ __('pages.view') }}
                                </button>
                            </li>
                        </ul>
                        <div class="item d-flex d-xxl-none flex-column flex-xxl-row justify-content-between align-items-end align-items-xxl-center">
                            <ul class="list-inline mb-0 d-flex align-items-center">
                                <li class="list-inline-item">
                                    <div class="city">{{ $firstCity->title ?? '' }}</div>
                                </li>
                                @if(!empty($firstCity->first_phone))
                                    <li class="list-inline-item">
                                        <a href="tel:{{ $firstCity->first_phone ?? '' }}">
                                            <div class="link-phone">{{ $firstCity->first_phone ?? '' }}</div>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty($firstCity->second_phone))
                                    <li class="list-inline-item">
                                        <a href="tel:{{ $firstCity->second_phone ?? '' }}">
                                            <div class="link-phone">{{ $firstCity->second_phone ?? '' }}</div>
                                        </a>
                                    </li>
                                @endif
                                <li class="list-inline-item">
                                    <button type="button" class="contact-details" data-toggle="modal" data-city="{{ $firstCity->title ?? '' }}"
                                        data-affiliates="{{ $firstCity->headerAffiliates }}"
                                        data-target="#popup--contacts">{{ __('pages.view') }}
                                    </button>
                                </li>
                            </ul>
                            <ul class="list-inline mb-0 d-flex align-items-center">
                                <li class="list-inline-item">
                                    <div class="city">{{ $secondCity->title ?? '' }}</div>
                                </li>
                                @if(!empty($secondCity->first_phone))
                                    <li class="list-inline-item">
                                        <a href="tel:{{ $secondCity->first_phone ?? '' }}"">
                                            <div class="link-phone">{{ $secondCity->first_phone ?? '' }}"</div>
                                        </a>
                                    </li>
                                @endif
                                <li class="list-inline-item">
                                    <button type="button" class="contact-details"
                                        data-toggle="modal"
                                        data-city="{{ $secondCity->title ?? '' }}"
                                        data-affiliates="{{ $secondCity->headerAffiliates }}"
                                        data-target="#popup--contacts">{{ __('pages.view') }}
                                    </button>
                                </li>
                            </ul>
                        </div>

                        {{-- <ul class="list-inline mb-0 d-none d-xxl-flex align-items-center">
                            <li class="list-inline-item">
                                <div class="city">Дніпро</div>
                            </li>
                            <li class="list-inline-item">
                                <a href="tel:+38 (095) 000-01-50">
                                    <div class="link-phone">+38 (095) 000-01-50</div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="tel:+38 (050) 325-62-93">
                                    <div class="link-phone">+38 (050) 325-62-93</div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="contact-details" data-toggle="modal"
                                        data-target="#popup--contacts">Переглянути
                                </button>
                            </li>
                        </ul>
                        <ul class="list-inline mb-0 d-none d-xxl-flex align-items-center mr-xxl-2">
                            <li class="list-inline-item">
                                <div class="city">Новомосковськ</div>
                            </li>
                            <li class="list-inline-item">
                                <a href="tel:+38 (050) 325-62-93">
                                    <div class="link-phone">+38 (050) 325-62-93</div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="contact-details" data-toggle="modal"
                                        data-target="#popup--contacts">Переглянути
                                </button>
                            </li>
                        </ul>
                        <div class="item d-flex d-xxl-none flex-column flex-xxl-row justify-content-between align-items-end align-items-xxl-center">
                            <ul class="list-inline mb-0 d-flex align-items-center">
                                <li class="list-inline-item">
                                    <div class="city">Дніпро</div>
                                </li>
                                <li class="list-inline-item">
                                    <a href="tel:+38 (095) 000-01-50">
                                        <div class="link-phone">+38 (095) 000-01-50</div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="tel:+38 (050) 325-62-93">
                                        <div class="link-phone">+38 (050) 325-62-93</div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="contact-details" data-toggle="modal"
                                            data-target="#popup--contacts">Переглянути
                                    </button>
                                </li>
                            </ul>
                            <ul class="list-inline mb-0 d-flex align-items-center">
                                <li class="list-inline-item">
                                    <div class="city">Новомосковськ</div>
                                </li>
                                <li class="list-inline-item">
                                    <a href="tel:+38 (050) 325-62-93">
                                        <div class="link-phone">+38 (050) 325-62-93</div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="contact-details" data-toggle="modal"
                                        data-target="#popup--contacts">Переглянути
                                    </button>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="item d-flex justify-content-between align-items-center mr-xxl-1">
                            <div class="d-xxl-none">
                                <button type="button" class="btn btn-blue" data-toggle="modal"
                                    data-target="#popup--sign-up-appointment">{{ __('pages.sign_up_for_for_appointment') }}
                                </button>
                            </div>
                            <div class="languages list-inline-item">
                                <div class="current-lang">
                                    <div class="current-lang--inner d-flex align-items-center">
                                        <div class="language mr-1">
                                            <span>{{ LaravelLocalization::getCurrentLocale() }}</span>
                                        </div>
                                        <svg class="i-arrow-down">
                                            <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-small-down' }}"></use>
                                        </svg>
                                    </div>
                                    <ul class="submenu list-unstyled mb-0 position-absolute py-1 px-2">
                                        {{-- @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @if ($localeCode !== LaravelLocalization::getCurrentLocale() && $localeCode !== 'en')
                                                <li>
                                                    <div class="language d-flex align-items-center">
                                                        <a class="d-flex" rel="alternate"
                                                        hreflang="{{ $localeCode }}"
                                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                            <span>{{ $localeCode }}</span>
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach --}}
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @if ($localeCode !== LaravelLocalization::getCurrentLocale() && $localeCode !== 'en')
                                                @php
                                                    $path = ltrim(parse_url(request()->getRequestUri(), PHP_URL_PATH), '/');
                                                    $segments = collect(explode('/', $path));
                                                    $locales = array_keys(LaravelLocalization::getSupportedLocales());

                                                    if ($segments->isNotEmpty() && in_array($segments->first(), $locales)) {
                                                        $segments->shift();
                                                    }

                                                    $newSegments = $localeCode !== 'ru'
                                                        ? $segments->prepend($localeCode)
                                                        : $segments;

                                                    $localizedUrl = url($newSegments->implode('/'));
                                                @endphp

                                                <li>
                                                    <div class="language d-flex align-items-center">
                                                        <a class="d-flex" rel="alternate" hreflang="{{ $localeCode }}" href="{{ $localizedUrl }}">
                                                            <span>{{ $localeCode }}</span>
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container position-relative">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg flex-column p-0">
                        <div class="inner w-100">
                            <div class="content d-flex justify-content-between">
                                <a class="navbar-brand p-0" href="{{ route('main') }}"><img src="{{ $headerImage ?? asset('static_images/logo.png') }}"
                                                                          alt="logo"></a>
                                <div class="navbar-nav--mob d-flex d-lg-none justify-content-between">
                                    <div class="languages">
                                        <div class="current-lang">
                                            <div class="current-lang--inner d-flex align-items-center">
                                                <div class="language mr-1">
                                                    <span>{{ LaravelLocalization::getCurrentLocale() }}</span>
                                                </div>
                                                <svg class="i-arrow-down">
                                                    <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-small-down' }}"></use>
                                                </svg>
                                            </div>
                                            <ul class="submenu list-unstyled mb-0 position-absolute py-1 px-2">
                                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    {{-- @if ($localeCode !== LaravelLocalization::getCurrentLocale() && $localeCode !== 'en')
                                                        <li>
                                                            <div class="language d-flex align-items-center">
                                                                <a class="d-flex" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                                    <span>{{ $localeCode }}</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endif --}}
                                                    @if ($localeCode !== LaravelLocalization::getCurrentLocale() && $localeCode !== 'en')
                                                        @php
                                                            $path = ltrim(parse_url(request()->getRequestUri(), PHP_URL_PATH), '/');
                                                            $segments = collect(explode('/', $path));
                                                            $locales = array_keys(LaravelLocalization::getSupportedLocales());

                                                            if ($segments->isNotEmpty() && in_array($segments->first(), $locales)) {
                                                                $segments->shift();
                                                            }

                                                            $newSegments = $localeCode !== 'ru'
                                                                ? $segments->prepend($localeCode)
                                                                : $segments;

                                                            $localizedUrl = url($newSegments->implode('/'));
                                                        @endphp

                                                        <li>
                                                            <div class="language d-flex align-items-center">
                                                                <a class="d-flex" rel="alternate" hreflang="{{ $localeCode }}" href="{{ $localizedUrl }}">
                                                                    <span>{{ $localeCode }}</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                {{-- <li>
                                                    <div class="language d-flex align-items-center">
                                                        <a class="d-flex" href="/">
                                                            <span>Ru</span>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="language d-flex align-items-center">
                                                        <a class="d-flex" href="/">
                                                            <span>Eng</span>
                                                        </a>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    <button class="navbar-toggler h-100 collapsed" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation" id="toggleMenu">
                                        <div class="menu-burger position-relative">
                                            <div class="lines"></div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse justify-content-between order-last"
                                 id="navbarSupportedContent">
                                <div class="header-main--desk d-none d-lg-flex align-items-center justify-content-end justify-content-xxl-between w-100">
                                    <div class="navbar-nav list-inline hover-aside-menu--list">
                                        <div class="list-inline-item">
                                            <div class="nav-link">
                                                <div class="nav-link--inner d-flex align-items-center">
                                                   <a href="{{ route('directions.page') }}"><span>{{ trans('web.directions') }}</span></a>
                                                </div>
                                                <div class="submenu position-absolute">
                                                    <div class="container">
                                                        <div class="push-menu">
                                                            <div class="push-menu--nav">
                                                                <div class="nav-toggle">
                                                                    <span class="nav-back">{{ trans('web.back') }}</span>
                                                                    <a href="{{ route('directions.page') }}"><span class="nav-title h3">{{ trans('web.directions') }}</span></a>
                                                                    <span class="nav-close"></span>
                                                                </div>
                                                                <div class="push-menu--lvl">

                                                                    <div class="push-menu--aside">
                                                                        @foreach ($allDirections->where('template', 3) as $direction)
                                                                            <div class="item"><a href="{{ $direction['full_path'] }}">{{ $direction['name'] }}</a></div>
                                                                        @endforeach
                                                                    </div>

                                                                    <div class="push-menu--category">
                                                                        @foreach ($allDirections->where('template', 1) as $category)
																			<div class="push-menu--sub-category">

                                                                                @if( $category['children'] )
                                                                                    <div class="item has-dropdown main-title">
                                                                                        <span class="heading" data-slug="{{ $category['full_path'] }}">{{ $category['name'] }}</span>
                                                                                        <div class="push-menu--lvl">
                                                                                            <x-site.directions.header-menu :data="collect($category['children'])" />
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="item main-title">
                                                                                        <a href="{{ $category['full_path'] }}" class="heading">{{ $category['name'] }}</a>
                                                                                    </div>
                                                                                @endif

                                                                                @foreach (collect($category['children']) as $subCategory)
                                                                                    @if( $subCategory['children'] )
                                                                                        <div class="item has-dropdown">
                                                                                            <span data-slug="{{ $subCategory['full_path'] }}">{{ $subCategory['name'] }}</span>
                                                                                            <div class="push-menu--lvl">
                                                                                                <x-site.directions.header-menu :data="collect($subCategory['children'])" />
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="item">
                                                                                            <a href="{{ $subCategory['full_path'] }}">{{ $subCategory['name'] }}</a>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
																			</div>
																		@endforeach
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-inline-item">
                                            <a class="nav-link" href="{{ route('surgery.index') }}">{{ __('pages.surgery') }}</a>
                                        </div>
                                        <div class="hover-aside-menu--item list-inline-item">
                                            <a class="nav-link" href="{{ route('about.us.page') }}">{{ __('pages.about_company') }}</a>
                                            @if($allCenters->count() > 0)
                                                <div class="hover-aside-menu--list">
                                                    <div class="hover-aside-menu--inner">
                                                        <div class="hover-aside-menu--content">
                                                            @foreach ($allCenters as $oneCenter)
                                                                <div class="hover-aside-menu--item"><a class="link" href="{{ route('one.center.page', ['slug' => $oneCenter->slug]) }}">{{ $oneCenter->title }}</a></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="hover-aside-menu--item position-right list-inline-item">
                                            <a class="nav-link" href="{{ route('promotions.index') }}">{{ __('pages.promotions') }}</a>
                                            <div class="hover-aside-menu--list">
                                                <div class="hover-aside-menu--inner">
                                                    <div class="hover-aside-menu--content">
                                                        <div class="hover-aside-menu--item"><a class="link"
                                                                                               href="{{ route('check-ups.index') }}">Check-up</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-inline-item">
                                            <a class="nav-link" href="{{ route('doctors.index') }}">{{ __('pages.doctors') }}</a>
                                        </div>
                                        <div class="list-inline-item">
                                            <a class="nav-link" href="{{ route('hospital.show') }}">{{ __('pages.hospital') }}</a>
                                        </div>
                                        <div class="list-inline-item">
                                            <a class="nav-link" href="{{ route('prices.page') }}">{{ __('pages.prices') }}</a>
                                        </div>
                                        <div class="hover-aside-menu--item position-left list-inline-item">
                                            <a class="nav-link" href="{{ route('contacts.page') }}">{{ __('pages.contacts') }}</a>
                                            <div class="hover-aside-menu--list">
                                                <div class="hover-aside-menu--inner">
                                                    <div class="hover-aside-menu--content">
                                                        <div class="hover-aside-menu--item">
                                                            <a class="link" href="{{ route('strahovym.kompaniyam.page') }}">{{ __('pages.insurance') }}</a>
                                                        </div>
                                                        <div class="hover-aside-menu--item">
                                                            <a class="link" href="{{ route('vacancy.index') }}">{{ __('pages.vacancies') }}</a>
                                                        </div>
                                                        <div class="hover-aside-menu--item">
                                                            <a class="link" href="{{ route('offices.page') }}">{{ __('pages.branches') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="navbar-nav--other d-none d-xxl-flex align-items-center">
                                        <button type="button" class="btn btn-blue" data-toggle="modal"
                                            data-target="#popup--sign-up-appointment">{{ trans('web.make_appointment') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="header-main--mob d-lg-none">
                                    <div class="push-menu d-flex flex-column justify-content-between">
                                        <div class="nav-toggle">
                                            <span class="nav-back"></span>
                                            <span class="nav-title">Menu</span>
                                            <span class="nav-close"></span>
                                        </div>
                                        <div class="push-menu--nav">
                                            <div class="push-menu--lvl scrollable-content">
                                                <div class="scrollable-content--inner">
                                                    <div class="item has-dropdown">
                                                        <span data-slug="{{ route('directions.page') }}">{{ trans('web.directions') }}</span>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a href="{{ route('directions.page') }}">{{ trans('web.directions') }}</a></div>
                                                                @foreach ($allDirections as $category)
                                                                    @if( $category['children'] )
                                                                        <div class="item has-dropdown">
                                                                            <span data-slug="{{ $category['full_path'] }}">{{ $category['name'] }}</span>

                                                                            <div class="push-menu--lvl scrollable-content">
                                                                                <x-site.directions.header-mob-menu :data="collect($category['children'])" />
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="item"><a href="{{ $category['full_path'] }}">{{ $category['name'] }}</a></div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item"><a href="{{ route('surgery.index') }}">{{ __('pages.surgery') }}</a></div>
                                                    <div class="item {{ ($allCenters->count() > 0) ? 'has-dropdown' : '' }}">
                                                        <a href="{{ route('about.us.page') }}" data-slug="{{ route('about.us.page') }}">{{ __('pages.about_company') }}</a>
                                                        @if($allCenters->count() > 0)
                                                            <div class="push-menu--lvl scrollable-content">
                                                                <div class="scrollable-content--inner">
                                                                    @foreach ($allCenters as $oneCenter)
                                                                        <div class="item"><a class="link" href="{{ route('one.center.page', ['slug' => $oneCenter->slug]) }}">{{ $oneCenter->title }}</a></div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="item has-dropdown">
                                                        <a href="{{ route('promotions.index') }}" data-slug="{{ route('promotions.index') }}">{{ __('pages.promotions') }}</a>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a href="{{ route('promotions.index') }}">{{ __('pages.promotions') }}</a></div>
                                                                <div class="item"><a href="{{ route('check-ups.index') }}">Check-up</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item"><a href="{{ route('doctors.index') }}">{{ __('pages.doctors') }}</a>
                                                    </div>
                                                    <div class="item"><a href="{{ route('hospital.show') }}">{{ __('pages.hospital') }}</a></div>
                                                    <div class="item"><a href="{{ route('prices.page') }}">{{ __('pages.prices') }}</a></div>
                                                    <div class="item has-dropdown">
                                                        <span data-slug="{{ route('contacts.page') }}">{{ __('pages.contacts') }}</span>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a href="{{ route('contacts.page') }}">{{ __('pages.contacts') }}</a></div>
                                                                <div class="item"><a href="{{ route('strahovym.kompaniyam.page') }}">{{ __('pages.insurance') }}</a></div>
                                                                <div class="item"><a href="{{ route('vacancy.index') }}">{{ __('pages.vacancies') }}</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="navbar-nav--other mb-5">
                                            <button type="button" class="btn btn-blue w-100 mb-5" data-toggle="modal"
                                            data-target="#popup--sign-up-appointment">{{ __('pages.sign_up_for_for_appointment') }}
                                            </button>
                                            <div class="contact-offices">
                                                <div class="contact-offices--label">{{ __('pages.view_branches') }}:</div>
                                                <div class="buttons">
                                                    <button type="button" class="contact-details btn"
                                                            data-toggle="modal"
                                                            data-target="#popup--contacts"
                                                            data-city="{{ $firstCity->title ?? '' }}"
                                                            data-affiliates="{{ $firstCity->headerAffiliates }}"
                                                            {{-- @forelse($firstCity->headerAffiliates as $affiliate)
                                                                @switch($loop->iteration)
                                                                    @case(1)
                                                                        data-first="{{ $affiliate }}"
                                                                        @break

                                                                    @case(2)
                                                                        data-second="{{ $affiliate }}"
                                                                        @break

                                                                    @case(3)
                                                                        data-third="{{ $affiliate }}"
                                                                        @break

                                                                    @case(4)
                                                                        data-fourth="{{ $affiliate }}"
                                                                        @break

                                                                    @default

                                                                @endswitch
                                                            @empty
                                                            @endforelse --}}
                                                            ><span>{{ $firstCity->title ?? '' }}</span>
                                                    </button>
                                                    <button type="button" class="contact-details btn"
                                                            data-toggle="modal"
                                                            data-target="#popup--contacts"
                                                            data-city="{{ $secondCity->title ?? '' }}"
                                                            data-affiliates="{{ $secondCity->headerAffiliates }}"
                                                            {{-- @forelse($secondCity->headerAffiliates as $affiliate)
                                                                @switch($loop->iteration)
                                                                    @case(1)
                                                                        data-first="{{ $affiliate }}"
                                                                        @break

                                                                    @case(2)
                                                                        data-second="{{ $affiliate }}"
                                                                        @break

                                                                    @case(3)
                                                                        data-third="{{ $affiliate }}"
                                                                        @break

                                                                    @case(4)
                                                                        data-fourth="{{ $affiliate }}"
                                                                        @break

                                                                    @default

                                                                @endswitch
                                                            @empty
                                                            @endforelse --}}
                                                            ><span>{{ $secondCity->title ?? '' }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
