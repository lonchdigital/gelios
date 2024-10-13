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

    <section class="about-top mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue mb-5">Про нас</div>
                    <div class="row">
                        <div class="col-12 col-md-8 col-xl-3">
                            <div class="h5 text-grey mb-8">Ласкаво просимо Медичний центр сімейного здоров’я і реабілітації
                                “Геліос”</div>
                        </div>
                    </div>
                    <div class="about-top--card row">
                        @foreach ($briefBlocks as $briefBlock)
                            <div class="item col-12 col-md-6 col-lg-4">
                                <div class="content">
                                    <div class="i-card">
                                        <img src="{{ '/storage/' . $briefBlock->image }}" alt="icon">
                                    </div>
                                    <div>
                                        <div class="h3 font-m text-blue font-weight-bolder mb-3">{{ $briefBlock->title }}
                                        </div>
                                        <p class="text-grey font-weight-bold mb-0">{{ $briefBlock->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="procedures py-8 py-md-16 bg-white mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                    <ul class="os-scrollbar-overflow list-unstyled mb-6">
                        {!! $pageMediaBlock->text !!}
                    </ul>
                    <button type="button" class="btn btn-blue" data-toggle="modal"
                        data-target="#popup--sign-up-appointment">Записатися на прийом</button>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="plyr__video-embed js-player">
                        <iframe
                            src="{{ $pageMediaBlock->video }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                            allowfullscreen allowtransparency allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offices mb-24">
        <div class="container overflow-hidden">
            <div class="row mb-8">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">Наші філії</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="offices--swiper">
                        <div class="swiper-wrapper">
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-1.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a>
                                    </div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-2.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a>
                                    </div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-3.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a>
                                    </div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-4.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a>
                                    </div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a></div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-3.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a
                                            href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a></div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a>
                                    </div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a>
                                    </div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                            <div class="offices--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/offices/img-office-4.jpeg" alt="img">
                                        <div class="city-label">м. Дніпро</div>
                                    </div>
                                    <div class="city-pin mb-3">м. Дніпро, <br>вул. Вернадського, 18а</div>
                                    <div class="email mb-2"><a
                                            href="mailto:helioscentr@gmail.com">helioscentr@gmail.com</a></div>
                                    <div class="phone mb-3"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a>
                                    </div>
                                    <div class="phone mb-4"><a href="tel:+38 (095) 000-01-50">+38 (095) 000-01-50</a>
                                    </div>
                                    <a href="##"
                                        class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Детальніше</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination mt-8"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="certificates mb-24">
        <div class="container overflow-hidden">
            <div class="row mb-8">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ trans('web.certificates') }}</div>
                </div>
            </div>
            <div class="certificates--swiper">
                <div class="swiper-wrapper mb-8">
                    @foreach ($сertificates as $сertificate)
                        <div class="certificates--item swiper-slide">
                            <a data-fancybox="certificates--gallery" href="{{ '/storage/' . $сertificate->image }}">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="{{ '/storage/' . $сertificate->image }}" alt="img">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="clinic-gallery mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="h2 font-m font-weight-bolder text-blue mb-8">Фото клініки</div>
                </div>
            </div>
            <div class="row">
                @if($photos->isNotEmpty())
                    <div class="col-12 col-lg-6 mb-3 mb-md-4 mb-lg-0">
                        <div class="clinic-gallery--wrap">
                            <a data-fancybox="clinic--gallery" href="{{ '/storage/' . $photos->first()->image }}">
                                <div class="wrap-img">
                                    <img src="{{ '/storage/' . $photos->first()->image }}" alt="img">
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            @foreach($photos->slice(1)->chunk(2) as $chunk)
                                <div class="col-6">
                                    <div class="clinic-gallery--small-wrap d-flex flex-column">
                                        @foreach($chunk as $photo)
                                            <a data-fancybox="clinic--gallery" href="{{ '/storage/' . $photo->image }}">
                                                <div class="wrap-img">
                                                    <img src="{{ '/storage/' . $photo->image }}" alt="img">
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p>No photos available.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
