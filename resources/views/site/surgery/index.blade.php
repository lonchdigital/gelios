@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
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
                'title' => 'Хірургія',
                'url' => null,
            ],
        ],
    ])
    <section class="section-top-2 mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6 mb-8 mb-xl-0">
                    <div
                        class="d-flex flex-column justify-content-end position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                        <div class="backdrop">
                            <div class="content">
                                <div class="h1 font-m font-weight-bolder mb-2 mb-lg-3">
                                    {{ $page->pageBlocks->where('block', 'main')->first()->title ?? '' }}
                                </div>
                                <div class="h5 font-weight-bold">
                                    {!! $page->pageBlocks->where('block', 'main')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="wrap-img">
                            @if (!empty($page->pageBlocks->where('block', 'main')->first()->image))
                                <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'main')->first()->image }}"
                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? '' }}">
                            @else
                                <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}" alt="img">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    @include('site.components.appointment-form')
                </div>
            </div>
        </div>
    </section>
    <section class="section-progress text-white mb-24">
        <div class="container">
            <div class="row flex-column flex-lg-row">
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="section-progress--item position-relative h-100 rounded overflow-hidden">
                        <div class="wrap-img">
                            @if(!empty($page->pageBlocks->where('block', 'second')->where('key', 'image')->first()->image))
                                <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'second')->where('key', 'image')->first()->imageUrl }}" alt="img">
                            @else
                                <img class="bg-down" src="img/img-251.jpeg" alt="img">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">{{ $page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->title ?? '' }}</div>
                                <div class="h5 text-uppercase">{!! $page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">{{ $page->pageBlocks->where('block', 'second')->where('key', 'second')->first()->title ?? '' }}</div>
                                <div class="h5 text-uppercase">{!! $page->pageBlocks->where('block', 'second')->where('key', 'second')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">{{ $page->pageBlocks->where('block', 'second')->where('key', 'third')->first()->title ?? '' }}</div>
                                <div class="h5 text-uppercase">{!! $page->pageBlocks->where('block', 'second')->where('key', 'third')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">{{ $page->pageBlocks->where('block', 'second')->where('key', 'fourth')->first()->title ?? '' }}</div>
                                <div class="h5 text-uppercase">{!! $page->pageBlocks->where('block', 'second')->where('key', 'fourth')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="media-content">
        <div class="container">
            @forelse($page->pageBlocks->where('block', 'static_block') as $block2)
                @if($loop->iteration % 2 == 1)
                    <div class="media-content--inner row flex-column-reverse flex-lg-row mb-24">
                        <div class="col-12 col-lg-6">
                            <div class="content-wrap">
                                <div class="content os-scrollbar-overflow">
                                    <p>{!! $block2->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            @if(!empty($block2->image))
                                <div class="wrap-img">
                                    <img src="{{ $block2->imageUrl }}" alt="img">
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse mb-24">
                        <div class="col-12 col-lg-6">
                            <div class="content-wrap">
                                <div class="content os-scrollbar-overflow">
                                    <p>{!! $block2->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            @if(!empty($block2->image))
                                <div class="wrap-img">
                                    <img src="{{ $block2->imageUrl }}" alt="img">
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
            @endif
        </div>
    </section>
    <section class="directions-list mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue mb-8">{{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}</div>
                    <div class="accordion" id="accordion-directions-list">
                        @forelse($directions as $direction)
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-directions-list-{{ $loop->iteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-directions-list-{{ $loop->iteration }}" aria-expanded="false"
                                            aria-controls="collapse-accordion-directions-list-{{ $loop->iteration }}">{{ $direction->title }}</div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-directions-list-{{ $loop->iteration }}" class="collapse"
                                    aria-labelledby="heading-accordion-directions-list-{{ $loop->iteration }}"
                                    data-parent="#accordion-directions-list">
                                    <div class="card-body media-content">
                                        @forelse($direction->surgeryBlocks as $block)
                                            @if($loop->iteration % 2 == 0)
                                                <div
                                                    class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="content-wrap">
                                                            <div class="content os-scrollbar-overflow">
                                                                <p>{!! $block->description ?? '' !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        @if(!empty($block->image))
                                                            <div class="wrap-img">
                                                                <img src="{{ $block->imageUrl }}" alt="{{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}">
                                                            </div>
                                                        @else
                                                            <div class="wrap-img">
                                                                <img src="img/media/image-226.jpeg" alt="{{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="content-wrap">
                                                            <div class="content os-scrollbar-overflow">
                                                                <p>{!! $block->description ?? '' !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        @if(!empty($block->image))
                                                            <div class="wrap-img">
                                                                <img src="{{ $block->imageUrl }}" alt="{{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}">
                                                            </div>
                                                        @else
                                                            <div class="wrap-img">
                                                                <img src="img/media/image-226.jpeg" alt="{{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                        {{-- <div class="card">
                            <div class="card-header p-0" id="heading-accordion-directions-list-2">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-accordion-directions-list-2" aria-expanded="false"
                                        aria-controls="collapse-accordion-directions-list-2">ЛОР-хірургія</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-directions-list-2" class="collapse"
                                aria-labelledby="heading-accordion-directions-list-2"
                                data-parent="#accordion-directions-list">
                                <div class="card-body media-content">
                                    <div
                                        class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-226.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-225.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-directions-list-3">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-accordion-directions-list-3" aria-expanded="false"
                                        aria-controls="collapse-accordion-directions-list-3">Судинна хірургія</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-directions-list-3" class="collapse"
                                aria-labelledby="heading-accordion-directions-list-3"
                                data-parent="#accordion-directions-list">
                                <div class="card-body media-content">
                                    <div
                                        class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-226.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-225.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-directions-list-4">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-accordion-directions-list-4" aria-expanded="false"
                                        aria-controls="collapse-accordion-directions-list-4">Абдомінальна хірургія</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-directions-list-4" class="collapse"
                                aria-labelledby="heading-accordion-directions-list-4"
                                data-parent="#accordion-directions-list">
                                <div class="card-body media-content">
                                    <div
                                        class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-226.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-225.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-directions-list-3">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-accordion-directions-list-5" aria-expanded="false"
                                        aria-controls="collapse-accordion-directions-list-5">Хірургія в ортопедії та
                                        травматології</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-directions-list-5" class="collapse"
                                aria-labelledby="heading-accordion-directions-list-5"
                                data-parent="#accordion-directions-list">
                                <div class="card-body media-content">
                                    <div
                                        class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-226.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-225.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-directions-list-6">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse-accordion-directions-list-6" aria-expanded="false"
                                        aria-controls="collapse-accordion-directions-list-6">Хірургічне лікування
                                        щитоподібної залози</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-directions-list-6" class="collapse"
                                aria-labelledby="heading-accordion-directions-list-6"
                                data-parent="#accordion-directions-list">
                                <div class="card-body media-content">
                                    <div
                                        class="media-content--inner row flex-column-reverse flex-lg-row mb-3 mb-md-4 mb-lg-5">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-226.jpeg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                        <div class="col-12 col-lg-6">
                                            <div class="content-wrap">
                                                <div class="content os-scrollbar-overflow">
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                    <p>Хірургія - великий відділ медицини, що вивчає та займається
                                                        лікуванням захворювань, травм із застосуванням оперативних методик.
                                                        У клініці Геліос у Дніпрі надаються хірургічні послуги у повному
                                                        обсязі.</p>
                                                    <p>Хірургічне відділення центру сімейного здоров'я та реабілітації
                                                        «Геліос» надає допомогу за такими напрямами, як загальна, судинна
                                                        хірургія та проктологія. Відділення оснащене сучасним обладнанням,
                                                        лапароскопічним комплексом, що дозволяє виконувати операції різного
                                                        рівня складності.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="wrap-img">
                                                <img src="img/media/image-225.jpeg" alt="img">
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

    @if(count($reviews) > 0)
        <section class="reviews mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-19">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder">{{ __('pages.reviews') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="reviews--swiper">
                            <div class="swiper-wrapper">
                                @foreach ($reviews as $review)
                                    @include('site.components.doctor-swiper', ['review' => $review])
                                @endforeach
                            </div>
                            <div class="swiper-pagination mt-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($page->pageBlocks->where('block', 'conditions')->where('key', 'image')->count())
        <section class="stay-conditions mb-24">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h2 font-m font-weight-bolder text-blue mb-3">{{ $page->pageBlocks->where('block', 'conditions')->where('key', 'title')->first()->title ?? '' }}</div>
                    </div>
                </div>
                <div class="row d-none d-lg-flex">
                    <div class="stay-conditions--item col-6">
                        @if(!empty($page->pageBlocks->where('block', 'conditions')->where('key', 'image')->first()->image))
                            <a href="{{ $page->pageBlocks->where('block', 'conditions')->where('key', 'image')->first()->imageUrl }}" data-fancybox="stay-conditions--gallery">
                                <div class="wrap-img">
                                    <img src="{{ $page->pageBlocks->where('block', 'conditions')->where('key', 'image')->first()->imageUrl }}" alt="img">
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @forelse($page->pageBlocks->where('block', 'conditions')->where('key', 'image')->take(3) as $block)
                                @if($loop->iteration !== 1)
                                    <div class="col-12 mb-5">
                                        <div class="stay-conditions--small-wrap">
                                            <a href="{{ $block->imageUrl }}" data-fancybox="stay-conditions--gallery">
                                                <div class="wrap-img">
                                                    <img src="{{ $block->imageUrl }}" alt="img">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row d-lg-none">
                    <div class="col">
                        <div class="stay-conditions--swiper">
                            <div class="swiper-wrapper">
                                @forelse($page->pageBlocks->where('block', 'conditions')->where('key', 'image') as $block)
                                    <div class="swiper-slide">
                                        <a href="{{ $block->imageUrl }}" data-fancybox="stay-conditions--gallery-mob">
                                            <div class="wrap-img">
                                                <img src="{{ $block->imageUrl }}" alt="img">
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="swiper-pagination mt-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->count())
        <section class="hospital mb-24">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h2 font-m font-weight-bolder text-blue mb-3">{{ $page->pageBlocks->where('block', 'Inpatient')->where('key', 'title')->first()->title ?? '' }}</div>
                    </div>
                </div>
                <div class="row d-none d-lg-flex">
                    <div class="col-6">
                        @if(!empty($page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->first()->image))
                            <a href="{{ $page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->first()->imageUrl }}" data-fancybox="hospital--gallery">
                                <div class="wrap-img">
                                    <img src="{{ $page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->first()->imageUrl }}" alt="img">
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @forelse($page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->take(3) as $block)
                                @if($loop->iteration !== 1)
                                    <div class="col-12 mb-5">
                                        <div class="stay-conditions--small-wrap">
                                            <a href="{{ $block->imageUrl }}" data-fancybox="hospital--gallery">
                                                <div class="wrap-img">
                                                    <img src="{{ $block->imageUrl }}" alt="img">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row d-lg-none">
                    <div class="col">
                        <div class="hospital--swiper">
                            <div class="swiper-wrapper">
                                @forelse($page->pageBlocks->where('block', 'Inpatient')->where('key', 'image') as $block)
                                    <div class="swiper-slide">
                                        <a href="{{ $block->imageUrl }}" data-fancybox="hospital--gallery-mob">
                                            <div class="wrap-img">
                                                <img src="{{ $block->imageUrl }}" alt="img">
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="swiper-pagination mt-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="tour mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue mb-8">3D тур</div>
                </div>
            </div>
        </div>
        <div class="tour tour-viewer"></div>
    </section>
    <section class="any-questions mb-24 py-xl-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    <form id="form-any-questions" class="p-5 bg-white">
                        <div class="h2 font-m font-weight-bolder mb-5">Залишилися запитання?</div>
                        <div class="row field-wrap">
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-any-questions-name-2">Вкажіть ПІБ</label>
                                    <input type="text" id="form-any-questions-name-2" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-any-questions-phone-2">Вкажіть номер
                                        телефону</label>
                                    <input type="tel" id="form-any-questions-phone-2" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть номер телефону</div>
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
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($page->seo_text))
            <section class="seo mb-24">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="h2 font-weight-bolder text-blue mb-8">{{ $page->meta_title }}</div>
                            <div class="seo-wrapper">
                                <div class="content os-scrollbar-overflow">
                                    {!! $page->seo_text !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
@endsection
