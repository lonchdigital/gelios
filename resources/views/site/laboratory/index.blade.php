@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => 'Лабораторії',
                'url' => null,
            ],
        ],
    ])
    <section class="section-top section-top-4 mb-8 mt-8">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-top--backdrop-swiper overflow-hidden h-100 position-relative">
                        <div class="swiper-wrapper">
                            @forelse($page->pageblocks->where('block', 'main') as $block)
                                <div
                                    class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                    <div class="backdrop p-3 p-lg-6">
                                        <div class="content mt-18">
                                            <div class="h1 font-m font-weight-bolder mb-3">{!! $block->title !!}
                                            </div>
                                            <div class="h5 font-m font-weight-bold mb-3">{{ $block->description }}</div>
                                            @if(!empty($block->url))
                                                <a href="{{ $block->url }}" class="btn btn-white font-weight-bold">{{ $block->button }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        @if(!empty($block->image))
                                            <img class="bg-down" src="{{ $block->imageUrl }}" alt="{{ $block->title }}">
                                        @else
                                            <img class="bg-down" src="img/img-background-1.jpeg" alt="img">
                                        @endif
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            {{-- <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-18">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?</div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/img-background-2.jpeg" alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-18">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?</div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/img-background-1.jpeg" alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-18">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?</div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/img-background-2.jpeg" alt="img">
                                </div>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="laboratory-benefits mb-24">
        <div class="container">
            <div class="laboratory-benefits--list row">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-syringe') }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->title }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-test-tube') }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->title }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-time') }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'third')->first()->title }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-heart-add') }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'fourth')->first()->title }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our-laboratories mb-24">
        <div class="container">
            <div class="row mb-8">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue">Наші лабараторії</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="accordion" id="our-laboratories-list">
                        @forelse($cities as $city)
                            <div class="card">
                                <div class="card-header p-0" id="heading-our-laboratories-list-{{ $loop->iteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-our-laboratories-list-{{ $loop->iteration }}"
                                            aria-expanded="false"
                                            aria-controls="collapse-our-laboratories-list-{{ $loop->iteration }}">
                                            {{ $city->title }}</div>
                                    </div>
                                </div>
                                <div id="collapse-our-laboratories-list-{{ $loop->iteration }}" class="collapse"
                                    aria-labelledby="heading-our-laboratories-list-{{ $loop->iteration }}"
                                    data-parent="#our-laboratories-list">
                                    <div class="card-body">
                                        <div class="row row-gap">
                                            @forelse($city->laboratories as $laboratory)
                                                <div class="col-12 col-lg-6">
                                                    <div class="item">
                                                        <ul class="list-unstyled mb-0">
                                                            <li>
                                                                <div class="head-address">Адреса:</div>
                                                                <div class="offices-address">{{ $laboratory->address }}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="head-phone">Телефон:</div>
                                                                <a href="tel:+38 (095) 000-01-50">
                                                                    <div class="link-phone">{{ $laboratory->phone }}</div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="head-email">Email:</div>
                                                                <a href="mailto:helioscentr@gmail.com">
                                                                    <div class="offices-email">{{ $laboratory->email }}
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="head-time">Години роботи:</div>
                                                                <div class="offices-time">{{ $laboratory->hours }}</div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{-- <div class="card">
                            <div class="card-header p-0" id="heading-our-laboratories-list-2">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-our-laboratories-list-2" aria-expanded="false"
                                        aria-controls="collapse-our-laboratories-list-2">Новомосковськ</div>
                                </div>
                            </div>
                            <div id="collapse-our-laboratories-list-2" class="collapse"
                                aria-labelledby="heading-our-laboratories-list-2" data-parent="#our-laboratories-list">
                                <div class="card-body">
                                    <div class="row row-gap">
                                        <div class="col-12 col-lg-6">
                                            <div class="item">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <div class="head-address">Адреса:</div>
                                                        <div class="offices-address">вул. Вернадського, 18а</div>
                                                    </li>
                                                    <li>
                                                        <div class="head-phone">Телефон:</div>
                                                        <a href="tel:+38 (095) 000-01-50">
                                                            <div class="link-phone">+38 (095) 000-01-50</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-email">Email:</div>
                                                        <a href="mailto:helioscentr@gmail.com">
                                                            <div class="offices-email">helioscentr@gmail.com</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-time">Години роботи:</div>
                                                        <div class="offices-time">08:00 - 20:00</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="item">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <div class="head-address">Адреса:</div>
                                                        <div class="offices-address">вул. Вернадського, 18а</div>
                                                    </li>
                                                    <li>
                                                        <div class="head-phone">Телефон:</div>
                                                        <a href="tel:+38 (095) 000-01-50">
                                                            <div class="link-phone">+38 (095) 000-01-50</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-email">Email:</div>
                                                        <a href="mailto:helioscentr@gmail.com">
                                                            <div class="offices-email">helioscentr@gmail.com</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-time">Години роботи:</div>
                                                        <div class="offices-time">08:00 - 20:00</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="item">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <div class="head-address">Адреса:</div>
                                                        <div class="offices-address">вул. Вернадського, 18а</div>
                                                    </li>
                                                    <li>
                                                        <div class="head-phone">Телефон:</div>
                                                        <a href="tel:+38 (095) 000-01-50">
                                                            <div class="link-phone">+38 (095) 000-01-50</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-email">Email:</div>
                                                        <a href="mailto:helioscentr@gmail.com">
                                                            <div class="offices-email">helioscentr@gmail.com</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-time">Години роботи:</div>
                                                        <div class="offices-time">08:00 - 20:00</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="item">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <div class="head-address">Адреса:</div>
                                                        <div class="offices-address">вул. Вернадського, 18а</div>
                                                    </li>
                                                    <li>
                                                        <div class="head-phone">Телефон:</div>
                                                        <a href="tel:+38 (095) 000-01-50">
                                                            <div class="link-phone">+38 (095) 000-01-50</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-email">Email:</div>
                                                        <a href="mailto:helioscentr@gmail.com">
                                                            <div class="offices-email">helioscentr@gmail.com</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="head-time">Години роботи:</div>
                                                        <div class="offices-time">08:00 - 20:00</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="laboratory-map mb-24">
        <div class="container">
            <div class="position-relative overflow-hidden mx-auto rounded">
                <div class="map-body h-100 overflow-hidden">
                    <div class="wrap-img h-100">
                        <div id="map2" class="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-us--laboratory about-us mb-24">
        <div class="container-max position-relative overflow-hidden mx-auto">
            <div class="container">
                <div class="row pt-16  pb-6 py-lg-16 text-white">
                    <div class="col col-md-8 col-xl-4">
                        <div class="content">
                            <div class="h2 font-m font-weight-bolder mb-3 mb-lg-5">{{ $page->pageBlocks->where('block', 'prices')->first()->title ?? '' }}</div>
                            <div class="h5 font-weight-bold mb-8 mb-lg-10">{{ $page->pageBlocks->where('block', 'prices')->first()->description ?? '' }}</div>
                            @if($page->pageBlocks->where('block', 'prices')->first()->url)
                                <a href="{{ $page->pageBlocks->where('block', 'prices')->first()->url }}" class="btn btn-white font-weight-bold">{{ $page->pageBlocks->where('block', 'prices')->first()->button ?? '' }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-img">
                @if(!empty($page->pageBlocks->where('block', 'prices')->first()->image))
                    <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'prices')->first()->imageUrl }}" alt="{{ $page->pageBlocks->where('block', 'prices')->first()->title }}">
                @else
                    <img class="bg-down" src="{{ asset('styles/img/img-background-2.jpeg') }}" alt="img">
                @endif
            </div>
        </div>
    </section>
    <section class="meeting mb-24 py-lg-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    <form id="form-meeting" class="p-3 p-lg-5 bg-white">
                        <div class="h2 font-m font-weight-bolder mb-5">Записатися на прийом</div>
                        <div class="row field-wrap">
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-meeting-name">Вкажіть ПІБ</label>
                                    <input type="text" id="form-meeting-name" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-meeting-phone">Вкажіть номер
                                        телефону</label>
                                    <input type="tel" id="form-meeting-phone" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть номер телефону</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <div class="control-label mb-2">Оберіть фахівця</div>
                                    <div class="select-wrap">
                                        <select class="select-choose-specialist">
                                            <option></option>
                                            <option value="1">Фахівeць 1</option>
                                            <option value="2">Фахівeць 2</option>
                                            <option value="3">Фахівeць 3</option>
                                            <option value="4">Фахівeць 4</option>
                                        </select>
                                    </div>
                                    <div class="field--help-info small-txt text-red mb-2">Оберіть фахівця</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <div class="control-label mb-2">Оберіть клініку</div>
                                    <div class="select-wrap">
                                        <select class="select-choose-clinic">
                                            <option></option>
                                            <option value="1">Клініка 1</option>
                                            <option value="2">Клініка 2</option>
                                            <option value="3">Клініка 3</option>
                                            <option value="4">Клініка 4</option>
                                        </select>
                                    </div>
                                    <div class="field--help-info small-txt text-red mb-2">Оберіть клініку</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button"
                                    class="btn btn-blue font-weight-bold w-100 mt-2">Записатися</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-5 col-lg-6 d-none d-lg-flex">
                    <div class="wrap-img">
                        <img src="img/img-right-b.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
