@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => __('pages.main_page'),
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? __('pages.promotions'),
                'url' => null,
            ],
        ],
    ])
    <section class="practice-activity section-top mb-11 mb-lg-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row mb-8">
                        <div class="col d-flex align-items-center justify-content-between">
                            <div class="h2 font-m font-weight-bolder text-blue">{{ $page->title ?? __('pages.promotions') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-11 mb-xl-0">
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
                                    {{-- <div
                                        class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                                        <div class="backdrop">
                                            <div class="content">
                                                <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про
                                                    здоров’я?</div>
                                                <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                                <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                            </div>
                                        </div>
                                        <div class="wrap-img">
                                            <img class="bg-down" src="img/img-background-2.jpeg" alt="img">
                                        </div>
                                    </div>
                                    <div
                                        class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                                        <div class="backdrop">
                                            <div class="content">
                                                <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про
                                                    здоров’я?</div>
                                                <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                                <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                            </div>
                                        </div>
                                        <div class="wrap-img">
                                            <img class="bg-down" src="img/img-background-1.jpeg" alt="img">
                                        </div>
                                    </div>
                                    <div
                                        class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                                        <div class="backdrop">
                                            <div class="content">
                                                <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про
                                                    здоров’я?</div>
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
                        <div class="col-12 col-xl-4">
                            @if(!empty($page->pageblocks->where('block', 'second')->first()->url))
                                <a
                                    @switch(LaravelLocalization::getCurrentLocale())
                                        @case('ua')
                                                href="{{ '/ua' . $page->pageblocks->where('block', 'second')->first()->url ?? '##' }}"
                                            @break

                                        @case('en')
                                                href="{{ '/en' . $page->pageblocks->where('block', 'second')->first()->url ?? '##' }}"
                                            @break

                                        @default
                                            href="{{ $page->pageblocks->where('block', 'second')->first()->url }}"
                                    @endswitch()
                                >
                            @endif
                            <div class="position-relative rounded-sm overflow-hidden text-white p-3 p-lg-6">
                                <div class="backdrop-small align-content-end d-flex flex-column justify-content-end">
                                    <div class="h3 font-m mb-2 font-weight-bolder">
                                        {!! $page->pageblocks->where('block', 'second')->first()->title ??
                                        '“Check-up” <br
                                            class="d-none d-xl-block">' . __('pages.programs') . '</div>' !!}</div>
                                    <div>
                                    {{-- @if(!empty($page->pageblocks->where('block', 'second')->first()->url))
                                        <a href="{{ $page->pageblocks->where('block', 'second')->first()->url }}" class="btn btn-white btn-sm font-weight-bold mb-3">{{ $page->pageblocks->where('block', 'second')->first()->button }}</a>
                                    @endif --}}
                                    </div>
                                    <p class="mb-0">{!! $page->pageblocks->where('block', 'second')->first()->description ?? __('pages.comprehensive_examination_and_expert_advice') !!}</p>
                                </div>
                                <div class="wrap-img">
                                    @if(!empty($page->pageblocks->where('block', 'second')->first()->image))
                                        <img class="bg-down" src="{{ $page->pageblocks->where('block', 'second')->first()->imageUrl }}" alt="{{ $page->pageblocks->where('block', 'second')->first()->title ?? 'Check-up' }}">
                                    @else
                                        <img class="bg-down" src="{{ asset('static_images/img-79.jpeg') }}" alt="img">
                                    @endif
                                </div>
                            </div>
                            @if(!empty($page->pageblocks->where('block', 'second')->first()->url))
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="shares" class="shares mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="shares-list row">
                        @forelse($promotions as $promotion)
                            <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                                <a href="{{ route('promotions.show', ['promotion' => $promotion->slug]) }}" class="inner">
                                    <div class="wrap-img mb-4">
                                        @if ($promotion->image)
                                            <img src="{{ $promotion->imageUrl }}" alt="{{ $promotion->title ?? '' }}">
                                        @endif
                                        {{-- <img src="img/shares/card-img-1.jpeg" alt="img"> --}}
                                    </div>
                                    <div class="h3 small">{!! $promotion->title !!}</div>
                                </a>
                            </div>
                        @empty
                        @endif
                        {{-- <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-1.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-1.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-1.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-1.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3 small">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav class="mt-5 mt-lg-3">
                                <ul class="pagination justify-content-center mb-0"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
