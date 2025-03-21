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
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => 'Блог',
                'url' => null,
            ],
        ],
    ])
    <section class="news-head mb-8">
        <div class="container">
            <div class="row align-items-center justify-content-between w-100 mb-5">
                <div class="col-auto">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ __('pages.blog') ?? 'Блог' }}</div>
                </div>
                <div class="col-auto">
                    <div class="field field-select-default">
                        <div class="select-wrap">
                            <select class="select-news-category">
                                <option></option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @empty
                                @endforelse

                                {{-- <option value="1">Гінеколог</option>
                                <option value="2">Стоматолог</option>
                                <option value="3">Хірург</option>
                                <option value="4">Отоларинголог</option>
                                <option value="5">Алерголог</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-top mb-8 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 col-xxl-8 mb-4 mb-lg-0">
                    <div class="section-top--backdrop-swiper overflow-hidden h-100 position-relative">
                        <div class="swiper-wrapper">
                            @forelse($page->pageBlocks->where('block', 'main')->where('key', 'slider') as $slide)
                                <div
                                    class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                    <div class="backdrop p-3 p-lg-6">
                                        <div class="content">
                                            <div class="h1 font-m font-weight-bolder mb-3">{!! $slide->title !!}
                                            </div>
                                            <div class="h5 font-m font-weight-bold mb-3">{!! $slide->description !!}</div>
                                            <a
                                                    @switch(LaravelLocalization::getCurrentLocale())
                                                        @case('ua')
                                                                href="{{ '/ua/' . $slide->url ?? '##' }}"
                                                            @break

                                                        @case('en')
                                                                href="{{ '/en/' . $slide->url ?? '##' }}"
                                                            @break

                                                        @default
                                                            href="{{ $slide->url ?? '##' }}"
                                                    @endswitch()
                                                    class="btn btn-white font-weight-bold"
                                                >{{ $slide->button }}</a>
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        @if (!empty($slide->image))
                                            <img class="bg-down" src="{{ $slide->imageUrl }}" alt="{!! $slide->title !!}">
                                        @else
                                            {{-- <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}" alt="{!! $slide->title !!}"> --}}
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                    <div class="backdrop p-3 p-lg-6">
                                        <div class="content">
                                            <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                            </div>
                                            <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                            <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}"
                                            alt="img">
                                    </div>
                                </div>
                            @endforelse
                            {{-- <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}"
                                        alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('static_images/img-background-2.jpeg') }}"
                                        alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}"
                                        alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('static_images/img-background-2.jpeg') }}"
                                        alt="img">
                                </div>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-12 col-lg-5 col-xxl-4">
                    <div class="row flex-row flex-lg-column">
                        @if (!empty($page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->url))
                            <a
                                href="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->url }}">
                        @endif
                        <div class="col-12 col-md-6 col-lg-12 mb-4 mb-md-0 mb-lg-5">
                            <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                <div class="backdrop-small align-content-end d-flex align-items-end p-3 p-lg-6 ">
                                    <div class="h4 font-weight-bolder mb-2">
                                        {!! $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->title ?? '' !!}
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    @if ($page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->image)
                                        <img class="bg-down"
                                            src="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->imageUrl }}"
                                            alt="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->title ?? '' }}">
                                    @else
                                        <img class="bg-down" src="{{ asset('static_images/img-79.jpeg') }}" alt="img">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (!empty($page->pageBlocks->where('block', 'second_block')->where('key', 'first')->first()->url))
                            </a>
                        @endif
                        @if (!empty($page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->url))
                            <a
                                href="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->url }}">
                        @endif
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                <div class="backdrop-small text-right p-3 p-lg-6">
                                    <div class="h4 font-weight-bolder">
                                        {!! $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->title ?? '' !!}
                                        {{-- Підпиши <br>декларацію <br>за 5 хвилин --}}
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    @if ($page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->image)
                                        <img class="bg-down"
                                            src="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->imageUrl }}"
                                            alt="{{ $page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->title ?? '' }}">
                                    @else
                                        <img class="bg-down" src="{{ asset('static_images/img-77.jpeg') }}" alt="img">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (!empty($page->pageBlocks->where('block', 'second_block')->where('key', 'second')->first()->url))
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="news" class="news mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="news-list row">
                        @forelse($articles as $article)
                            <div class="content-item col-12 col-md-6 col-xl-4">
                                <div class="news--item">
                                    <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" class="inner">
                                        <div class="wrap-img mb-4">
                                            @if ($article->image)
                                                <img src="{{ $article->imageUrl }}" alt="{{ $article->title }}">
                                            @else
                                                <img src="{{ asset('static_images/articles/article-1.jpeg') }}"
                                                    alt="img">
                                            @endif
                                            <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}
                                                {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }}
                                                {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                                        </div>
                                        <div class="h3 small mb-2">{{ $article->title }}</div>
                                        <div class="h6 descrp">{!! $article->description !!}</div>
                                    </a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{-- <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('static_images/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="mt-5 mt-lg-3">
                        @include('vendor.pagination.custom', ['articles' => $articles])

                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12">
                    <nav class="mt-5 mt-lg-3">
                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
