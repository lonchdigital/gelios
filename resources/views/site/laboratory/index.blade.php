@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title . ' ' . __('web.direction_meta_title'),
        'description' => $page->meta_description ?: $page->title . ' ' . __('web.direction_meta_description'),
        'url' => $url
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => $page->title,
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
                                            <div class="h5 font-m font-weight-bold mb-3">{!! $block->description !!}</div>
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
                                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-syringe' }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->title ?? '' }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-test-tube' }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->title ?? '' }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-time' }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'third')->first()->title ?? '' }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="item">
                        <div class="wrap-svg">
                            <svg>
                                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-heart-add' }}"></use>
                            </svg>
                        </div>
                        <div class="h4 text-blue font-weight-bolder">{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'fourth')->first()->title ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our-laboratories mb-24">
        <div class="container">
            <div class="row mb-8">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ __('pages.our_laboratories') }}</div>
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
                                                                <div class="head-address">{{ __('pages.address') }}:</div>
                                                                <div class="offices-address">{{ $laboratory->address }}
                                                                </div>
                                                            </li>
                                                            @forelse($laboratory->phones as $phone)
                                                                <li>
                                                                    <div class="head-phone">{{ __('pages.phone') }}:</div>
                                                                    <a href="tel:{{ $phone }}">
                                                                        <div class="link-phone">{{ $phone }}</div>
                                                                    </a>
                                                                </li>
                                                            @empty
                                                            @endforelse
                                                            {{-- <li>
                                                                <div class="head-phone">{{ __('pages.phone') }}:</div>
                                                                <a href="tel:{{ $laboratory->phone }}">
                                                                    <div class="link-phone">{{ $laboratory->phone }}</div>
                                                                </a>
                                                            </li> --}}
                                                            <li>
                                                                <div class="head-email">Email:</div>
                                                                <a href="mailto:helioscentr@gmail.com">
                                                                    <div class="offices-email">{{ $laboratory->email }}
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="head-time">{{ __('pages.working_hours') }}:</div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($page->pageBlocks->where('block', 'map')->where('key', 'longitude')->first()->title) && !empty($page->pageBlocks->where('block', 'map')->where('key', 'latitude')->first()->title))
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
    @endif
    <section class="about-us--laboratory about-us mb-24">
        <div class="container-max position-relative overflow-hidden mx-auto">
            <div class="container">
                <div class="row pt-16  pb-6 py-lg-16 text-white">
                    <div class="col col-md-8 col-xl-4">
                        <div class="content">
                            <div class="h2 font-m font-weight-bolder mb-3 mb-lg-5">{{ $page->pageBlocks->where('block', 'prices')->first()->title ?? '' }}</div>
                            <div class="h5 font-weight-bold mb-8 mb-lg-10">{!! $page->pageBlocks->where('block', 'prices')->first()->description ?? '' !!}</div>
                            @if(!empty($page->pageBlocks->where('block', 'prices')->first()->url))
                                <a
                                href="/laboratories/prices"
                                {{-- href="{{ $page->pageBlocks->where('block', 'prices')->first()->url }}" --}}
                                 class="btn btn-white font-weight-bold">{{ $page->pageBlocks->where('block', 'prices')->first()->button ?? '' }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-img">
                @if(!empty($page->pageBlocks->where('block', 'prices')->first()->image))
                    <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'prices')->first()->imageUrl }}" alt="{{ $page->pageBlocks->where('block', 'prices')->first()->title }}">
                @else
                    <img class="bg-down" src="{{ asset('static_images/img-background-2.jpeg') }}" alt="img">
                @endif
            </div>
        </div>
    </section>
    @if(count($articles))
        <section class="news mb-24">
            <div class="container overflow-hidden">
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-between mb-5">
                        <div class="h2 font-m font-weight-bolder">{{ __('pages.news') }}</div>
                        <a href="{{ route('articles.index') }}" class="btn btn-white font-weight-bold">{{ __('pages.all_news') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="news--swiper">
                            <div class="swiper-wrapper">
                                {{-- <div class="swiper-slide news--item">
                                    <a href="##" class="inner">
                                        <div class="wrap-img mb-4">
                                            <img src="img/articles/article-1.jpeg" alt="img">
                                            <div class="date-label">13 березня 2024</div>
                                        </div>
                                        <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                        <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує..</div>
                                    </a>
                                </div>
                                <div class="swiper-slide news--item">
                                    <a href="##" class="inner">
                                        <div class="wrap-img mb-4">
                                            <img src="img/articles/article-2.jpeg" alt="img">
                                            <div class="date-label">13 березня 2024</div>
                                        </div>
                                        <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                        <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує..</div>
                                    </a>
                                </div>
                                <div class="swiper-slide news--item">
                                    <a href="##" class="inner">
                                        <div class="wrap-img mb-4">
                                            <img src="img/articles/article-3.jpeg" alt="img">
                                            <div class="date-label">13 березня 2024</div>
                                        </div>
                                        <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                        <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі пропонує..</div>
                                    </a>
                                </div> --}}
                                @forelse($articles as $article)
                                        <div class="swiper-slide news--item">
                                            <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" class="inner">
                                                <div class="wrap-img mb-4">
                                                    @if($article->image)
                                                    <img src="{{ $article->imageUrl }}" alt="{{ $article->title ?? '' }}">
                                                    @else
                                                    <img src="{{ asset('static_images/articles/article-1.jpeg') }}" alt="img">
                                                    @endif
                                                    <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}
                                                        {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }}
                                                        {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                                                </div>
                                                <div class="h3 small mb-2">{{ $article->title }}</div>
                                                <div class="descrp">{!! $article->description !!}</div>
                                            </a>
                                        </div>
                                    @empty
                                    @endforelse
                            </div>
                            <div class="swiper-pagination mt-6 d-xl-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="meeting mb-24 py-lg-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    @include('site.components.appointment-form')
                </div>
                <div class="col-5 col-lg-6 d-none d-lg-flex">
                    <div class="wrap-img">
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="{{ $page->title ?? 'Laboratory' }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
