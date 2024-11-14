@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])


    <section class="offices-top mb-8">
        <div class="container">
            <div class="row mb-8">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue">Філії</div>
                </div>
            </div>
            <div class="row">
                <div class="col position-static">
                    <div class="offices--swiper--wrapper position-relative">
                        <div class="offices-anchor--swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="##" class="anchor">
                                        <div class="city-pin">м. Дніпро</div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-buttons d-flex">
                                <div class="button-slider-prev">
                                    <svg>
                                        <use xlink:href="img/icons/icons.svg#i-arrow-right"></use>
                                    </svg>
                                </div>
                                <div class="button-slider-next">
                                    <svg>
                                        <use xlink:href="img/icons/icons.svg#i-arrow-right"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offices-direction mb-24 mb-lg-0">
        @foreach ($contacts as $contact)
            <div class="offices-direction--item py-12 bg-white mb-8">
                <div class="container">
                    <div class="offices-direction--content">
                        <div class="row">
                            <div class="col">
                                <div class="push-menu">
                                    <div class="push-menu--nav">
                                        <div class="nav-toggle">
                                            <a href="##"
                                                class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>Назад</span><span
                                                    class="icon"></span></a>
                                            <a href="##"
                                                class="btn-nav-forward btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>Усі
                                                    напрямки</span><span class="icon"></span></a>
                                        </div>
                                        <div class="push-menu--lvl position-relative">
                                            <div class="item has-dropdown">
                                                <div class="row offices-direction--body">
                                                    <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                                                        <div class="position-relative">
                                                            <!-- main slider -->
                                                            <div class="offices-direction--swiper">
                                                                <div class="swiper-wrapper">
                                                                    <div class="swiper-slide">
                                                                        <a href="img/offices/img-office-1.jpeg"
                                                                            data-fancybox="offices-direction--gallery-1">
                                                                            <div class="wrap-img">
                                                                                <img src="img/offices/img-office-1.jpeg"
                                                                                    alt="img">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <a href="img/offices/img-office-2.jpeg"
                                                                            data-fancybox="offices-direction--gallery-1">
                                                                            <div class="wrap-img">
                                                                                <img src="img/offices/img-office-2.jpeg"
                                                                                    alt="img">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <a href="img/offices/img-office-3.jpeg"
                                                                            data-fancybox="offices-direction--gallery-1">
                                                                            <div class="wrap-img">
                                                                                <img src="img/offices/img-office-3.jpeg"
                                                                                    alt="img">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <a href="img/offices/img-office-4.jpeg"
                                                                            data-fancybox="offices-direction--gallery-1">
                                                                            <div class="wrap-img">
                                                                                <img src="img/offices/img-office-4.jpeg"
                                                                                    alt="img">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-buttons d-flex">
                                                                    <div class="button-slider-prev">
                                                                        <svg>
                                                                            <use
                                                                                xlink:href="img/icons/icons.svg#i-arrow-small-down">
                                                                            </use>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="button-slider-next">
                                                                        <svg>
                                                                            <use
                                                                                xlink:href="img/icons/icons.svg#i-arrow-small-down">
                                                                            </use>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- thumbs slider -->
                                                            <div class="offices-direction-thumbs--swiper">
                                                                <div class="swiper-wrapper">
                                                                    <div class="swiper-slide">
                                                                        <div class="wrap-img">
                                                                            <img src="img/offices/img-office-1.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <div class="wrap-img">
                                                                            <img src="img/offices/img-office-2.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <div class="wrap-img">
                                                                            <img src="img/offices/img-office-3.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <div class="wrap-img">
                                                                            <img src="img/offices/img-office-4.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4  mb-5 mb-lg-0">
                                                        <div
                                                            class="offices-direction--descrp d-flex flex-column justify-content-between h-100">
                                                            <div class="h3 font-weight-bolder mb-5">Геліос Ламана</div>
                                                            <p class="mb-5 mb-lg-8">Медичний центр сімейного здоров'я та
                                                                реабілітації “Геліос” у Дніпрі пропонує прийом
                                                                лікаря-анестезіолога пацієнтам, які готуються до планового
                                                                хірургічного втручання.<br>
                                                                Оперативне лікування неможливе без анестезіолога-реаніматолога.
                                                                Медичний центр сімейного здоров'я та реабілітації “Геліос”.</p>
                                                            <a href="##" class="btn btn-blue font-weight-bold px-xl-14"
                                                                data-toggle="modal"
                                                                data-target="#popup--sign-up-appointment">Записатись на
                                                                прийом</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="offices-direction--contact">
                                                            <div class="city-pin mb-2">{{ $contact->city }}, вул. Вернадського, 18а</div>
                                                            <div class="email mb-2"><a
                                                                    href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a>
                                                            </div>
                                                            <div class="phone mb-2"><a href="tel:+38 (095) 000-01-50">+38
                                                                    (095) 000-01-50</a></div>
                                                            <div class="phone mb-2"><a href="tel:+38 (095) 000-01-50">+38
                                                                    (095) 000-01-50</a></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="push-menu--lvl">
                                                    <div class="item has-dropdown">
                                                        <div class="category-directions">
                                                            <div class="category-directions--list ">
                                                                <div class="row">
                                                                    @foreach ($contact->getDirectionsTree() as $item)
                                                                        <div class="col-12 col-lg-4 col-xl-3 position-static">
                                                                            @if( $item['children'] )
                                                                                <div class="directions-item">
                                                                                    <div class="content item has-dropdown">
                                                                                        <a href="##" class="link">
                                                                                            <span>{{ $item['name'] }}</span>
                                                                                            <div class="i-link"></div>
                                                                                        </a>
                                                                                        @include('site.directions.partials.section-menu', ['data' => $item['children']])
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="directions-item">
                                                                                    <div class="content">
                                                                                        <a class="link" href="{{ route('web.page.show', ['slug' => $item['slug']]) }}">
                                                                                            {{ $item['name'] }}
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section class="meeting mb-24 py-lg-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    @include('site.components.appointment-form')
                </div>
                <div class="col-5 col-lg-6 d-none d-lg-flex">
                    <div class="wrap-img">
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
