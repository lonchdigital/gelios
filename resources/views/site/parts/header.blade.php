<header class="header">
    <div class="header-top d-none d-lg-block w-100">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="inner d-flex justify-content-between align-items-center py-2">
                        <ul class="list-inline mb-0 d-none d-xxl-flex align-items-center">
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
                        </div>
                        <div class="item d-flex justify-content-between align-items-center mr-xxl-1">
                            <div class="d-xxl-none">
                                <button type="button" class="btn btn-blue" data-toggle="modal"
                                        data-target="#popup--sign-up-appointment">Записатися на прийом
                                </button>
                            </div>
                            <div class="languages list-inline-item">
                                <div class="current-lang">
                                    <div class="current-lang--inner d-flex align-items-center">
                                        <div class="language mr-1">
                                            <span>{{ LaravelLocalization::getCurrentLocale() }}</span>
                                        </div>
                                        <svg class="i-arrow-down">
                                            <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-arrow-small-down') }}"></use>
                                        </svg>
                                    </div>
                                    <ul class="submenu list-unstyled mb-0 position-absolute py-1 px-2">
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @if ($localeCode !== LaravelLocalization::getCurrentLocale())
                                                <li>
                                                    <div class="language d-flex align-items-center">
                                                        <a class="d-flex" rel="alternate" hreflang="{{ $localeCode }}"
                                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
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
                                <a class="navbar-brand p-0" href="/"><img src="{{ asset('styles/img/logo.png') }}"
                                                                          alt="logo"></a>
                                <div class="navbar-nav--mob d-flex d-lg-none justify-content-between">
                                    <div class="languages">
                                        <div class="current-lang">
                                            <div class="current-lang--inner d-flex align-items-center">
                                                <div class="language mr-1">
                                                    <span>Ua</span>
                                                </div>
                                                <svg class="i-arrow-down">
                                                    <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-arrow-small-down') }}"></use>
                                                </svg>
                                            </div>
                                            <ul class="submenu list-unstyled mb-0 position-absolute py-1 px-2">
                                                <li>
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
                                                </li>
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
													{{-- @dd( collect($allDirections[3]['children']) ) --}}
													{{-- @dd( $allDirections[3] ) --}}
                                                    <span>Напрямки</span>
                                                </div>
                                                <div class="submenu position-absolute">
                                                    <div class="container">
                                                        <div class="push-menu">
                                                            <div class="push-menu--nav">
                                                                <div class="nav-toggle">
                                                                    <span class="nav-back">Назад</span>
                                                                    <span class="nav-title h3">Напрямки</span>
                                                                    <span class="nav-close"></span>
                                                                </div>
                                                                <div class="push-menu--lvl">

                                                                    <div class="push-menu--aside">
                                                                        @foreach ($allDirections->where('template', 3) as $direction)
                                                                            <div class="item"><a href="{{ route('direction.itself', ['pageDirection' => $direction['slug']]) }}">{{ $direction['name'] }}</a></div>
                                                                        @endforeach
                                                                    </div>

                                                                    <div class="push-menu--category">
                                                                        @foreach ($allDirections->where('template', 1) as $category)
																			<div class="push-menu--sub-category">

                                                                                @if( $category['children'] )
                                                                                    <div class="item has-dropdown main-title">
                                                                                        <a href="##" class="heading">{{ $category['name'] }}</a>
                                                                                        <div class="push-menu--lvl">
                                                                                            @include('site.directions.partials.header-menu', ['data' => collect($category['children'])])
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="item main-title">
                                                                                        <a href="{{ route('direction.category', ['pageDirection' => $category['slug']]) }}" class="heading">{{ $category['name'] }}</a>
                                                                                    </div>
                                                                                @endif

                                                                                @foreach (collect($category['children']) as $subCategory)
                                                                                    @if( $subCategory['children'] )
                                                                                        <div class="item has-dropdown">
                                                                                            <a href="##">{{ $subCategory['name'] }}</a>
                                                                                            <div class="push-menu--lvl">
                                                                                                @include('site.directions.partials.header-menu', ['data' => collect($subCategory['children'])])
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="item">
                                                                                            @if ($subCategory['template'] === 2)
                                                                                                <a href="{{ route('direction.sub-category', ['pageDirection' => $subCategory['slug']]) }}">
                                                                                                    {{ $subCategory['name'] }}
                                                                                                </a>
                                                                                            @elseif ($subCategory['template'] === 3)
                                                                                                <a href="{{ route('direction.itself', ['pageDirection' => $subCategory['slug']]) }}">
                                                                                                    {{ $subCategory['name'] }}
                                                                                                </a>
                                                                                            @endif
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
                                        <div class="list-inline-item"><a class="nav-link"
                                                                         href="{{ route('surgery.index') }}">Хірургія</a>
                                        </div>
                                        <div class="list-inline-item"><a class="nav-link" href="##">Про компанію</a>
                                        </div>
                                        <div class="hover-aside-menu--item position-right list-inline-item"><a
                                                    class="nav-link" href="{{ route('promotions.index') }}">Акції</a>
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
                                        <div class="list-inline-item"><a class="nav-link"
                                                                         href="{{ route('doctors.index') }}">Лікарі</a>
                                        </div>
                                        <div class="list-inline-item"><a class="nav-link" href="##">Стаціонар</a></div>
                                        <div class="list-inline-item"><a class="nav-link" href="##">Ціни</a></div>
                                        <div class="hover-aside-menu--item position-left list-inline-item"><a
                                                    class="nav-link" href="##">Контакти</a>
                                            <div class="hover-aside-menu--list">
                                                <div class="hover-aside-menu--inner">
                                                    <div class="hover-aside-menu--content">
                                                        <div class="hover-aside-menu--item"><a class="link" href="##">Страхові</a>
                                                        </div>
                                                        <div class="hover-aside-menu--item"><a class="link" href="##">Вакансії</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="navbar-nav--other d-none d-xxl-flex align-items-center">
                                        <button type="button" class="btn btn-blue" data-toggle="modal"
                                                data-target="#popup--sign-up-appointment">Записатися на прийом
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
                                                        <a href="##">Напрямки</a>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a href="##">Напрямки</a></div>
                                                                <div class="item has-dropdown">
                                                                    <a href="##">Дієтологія</a>
                                                                    <div class="push-menu--lvl scrollable-content">
                                                                        <div class="scrollable-content--inner">
                                                                            <div class="item"><a href="##">Гастроентеролог</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a
                                                                                        href="##">Алергологія</a></div>
                                                                            <div class="item"><a
                                                                                        href="##">Гематологія</a></div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item has-dropdown">
                                                                    <a href="##">Кардіологія</a>
                                                                    <div class="push-menu--lvl scrollable-content">
                                                                        <div class="scrollable-content--inner">
                                                                            <div class="item"><a href="##">Гастроентеролог</a>
                                                                            </div>
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                            <div class="item"><a
                                                                                        href="##">Гематологія</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item has-dropdown">
                                                                    <a href="##">Неврологія</a>
                                                                    <div class="push-menu--lvl scrollable-content">
                                                                        <div class="scrollable-content--inner">
                                                                            <div class="item"><a href="##">Гастроентеролог</a>
                                                                            </div>
                                                                            <div class="item"><a
                                                                                        href="##">Гематологія</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item has-dropdown">
                                                                    <a href="##">Ендокринологія</a>
                                                                    <div class="push-menu--lvl scrollable-content">
                                                                        <div class="scrollable-content--inner">
                                                                            <div class="item"><a href="##">Дерматовенерологія</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                                <div class="item"><a href="##">Дерматовенерологія</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item"><a href="##">Хірургія</a></div>
                                                    <div class="item"><a href="##">Про компанію</a></div>
                                                    <div class="item has-dropdown">
                                                        <a href="{{ route('promotions.index') }}">Акції</a>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a
                                                                            href="{{ route('promotions.index') }}">Акції</a>
                                                                </div>
                                                                <div class="item"><a
                                                                            href="{{ route('check-ups.index') }}">Check-up</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item"><a href="{{ route('doctors.index') }}">Лікарі</a>
                                                    </div>
                                                    <div class="item"><a href="##">Стаціонар</a></div>
                                                    <div class="item"><a href="##">Ціни</a></div>
                                                    <div class="item has-dropdown">
                                                        <a href="##">Контакти</a>
                                                        <div class="push-menu--lvl scrollable-content">
                                                            <div class="scrollable-content--inner">
                                                                <div class="item"><a href="##">Контакти</a></div>
                                                                <div class="item"><a href="##">Страхові</a></div>
                                                                <div class="item"><a href="##">Вакансії</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="navbar-nav--other mb-5">
                                            <button type="button" class="btn btn-blue w-100 mb-5" data-toggle="modal"
                                                    data-target="#popup--sign-up-appointment">Записатися на прийом
                                            </button>
                                            <div class="contact-offices">
                                                <div class="contact-offices--label">Переглянути філії:</div>
                                                <div class="buttons">
                                                    <button type="button" class="contact-details btn"
                                                            data-toggle="modal" data-target="#popup--contacts"><span>Дніпро</span>
                                                    </button>
                                                    <button type="button" class="contact-details btn"
                                                            data-toggle="modal" data-target="#popup--contacts"><span>Новомосковськ</span>
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
 