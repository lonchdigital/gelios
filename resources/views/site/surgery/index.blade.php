@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title . ' ' . __('web.direction_meta_title'),
        'description' => $page->meta_description ?: $page->title . ' ' . __('web.direction_meta_description'),
        'url' => $url
    ])
@endsection

@section('NOINDEX')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => $page->title ?? __('pages.surgery'),
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
                                <img class="bg-down"
                                    src="{{ $page->pageBlocks->where('block', 'main')->first()->imageUrl }}"
                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? __('pages.surgery') }}">
                            @else
                                <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}"
                                    alt="{{ __('pages.surgery') }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    @include('site.components.appointment-form', ['id' => 1])
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
                            @if (!empty($page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->image))
                                <img class="bg-down"
                                    src="{{ $page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->imageUrl }}"
                                    alt="{{ __('pages.surgery') }}">
                            @else
                                <img class="bg-down" src="img/img-251.jpeg" alt="{{ __('pages.surgery') }}">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">
                                    {{ $page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->title ?? '' }}
                                </div>
                                <div class="h5">{!! $page->pageBlocks->where('block', 'second')->where('key', 'first')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">
                                    {{ $page->pageBlocks->where('block', 'second')->where('key', 'second')->first()->title ?? '' }}
                                </div>
                                <div class="h5">{!! $page->pageBlocks->where('block', 'second')->where('key', 'second')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">
                                    {{ $page->pageBlocks->where('block', 'second')->where('key', 'third')->first()->title ?? '' }}
                                </div>
                                <div class="h5">{!! $page->pageBlocks->where('block', 'second')->where('key', 'third')->first()->description ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">
                                    {{ $page->pageBlocks->where('block', 'second')->where('key', 'fourth')->first()->title ?? '' }}
                                </div>
                                <div class="h5">{!! $page->pageBlocks->where('block', 'second')->where('key', 'fourth')->first()->description ?? '' !!}</div>
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
                @if ($loop->iteration % 2 == 1)
                    <div class="media-content--inner row flex-column-reverse flex-lg-row mb-24">
                        <div class="col-12 col-lg-6">
                            <div class="content-wrap">
                                <div class="content os-scrollbar-overflow">
                                    <p>{!! $block2->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            @if (!empty($block2->image))
                                <div class="wrap-img">
                                    <img src="{{ $block2->imageUrl }}" alt="{{ $block2->description ?? __('pages.surgery') }}">
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
                            @if (!empty($block2->image))
                                <div class="wrap-img">
                                    <img src="{{ $block2->imageUrl }}" alt="{{ $block2->description ?? __('pages.surgery') }}">
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
                    <div class="h2 font-m font-weight-bolder text-blue mb-8">
                        {{ $page->pageBlocks->where('block', 'directions')->first()->title ?? '' }}</div>
                    <div class="accordion" id="accordion-directions-list">
                        @forelse($directions as $direction)
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-directions-list-{{ $loop->iteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-directions-list-{{ $loop->iteration }}"
                                            aria-expanded="false"
                                            aria-controls="collapse-accordion-directions-list-{{ $loop->iteration }}">
                                            {{ $direction->title }}</div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-directions-list-{{ $loop->iteration }}" class="collapse"
                                    aria-labelledby="heading-accordion-directions-list-{{ $loop->iteration }}"
                                    data-parent="#accordion-directions-list">
                                    <div class="card-body media-content">
                                        @forelse($direction->surgeryBlocks as $block)
                                            @if ($loop->iteration % 2 == 0)
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
                                                        @if (!empty($block->image))
                                                            <div class="wrap-img">
                                                                <img src="{{ $block->imageUrl }}"
                                                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? __('pages.surgery') }}">
                                                            </div>
                                                        @else
                                                            <div class="wrap-img">
                                                                <img src="img/media/image-226.jpeg"
                                                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? __('pages.surgery') }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="media-content--inner row flex-column-reverse flex-lg-row-reverse">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="content-wrap">
                                                            <div class="content os-scrollbar-overflow">
                                                                <p>{!! $block->description ?? '' !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        @if (!empty($block->image))
                                                            <div class="wrap-img">
                                                                <img src="{{ $block->imageUrl }}"
                                                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? __('pages.surgery') }}">
                                                            </div>
                                                        @else
                                                            <div class="wrap-img">
                                                                <img src="img/media/image-226.jpeg"
                                                                    alt="{{ $page->pageBlocks->where('block', 'main')->first()->title ?? __('pages.surgery') }}">
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
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const accordionContainer = document.querySelector("#accordion-directions-list");

                                if (accordionContainer) {
                                    accordionContainer.querySelectorAll(".collapse").forEach(function (accordion) {
                                        const accordionButton = document.querySelector(`[data-target="#${accordion.id}"]`) ||
                                                                document.querySelector(`[data-toggle="collapse"][href="#${accordion.id}"]`);

                                        if (accordionButton) {
                                            accordionButton.addEventListener("click", function () {
                                                setTimeout(() => {
                                                    if (accordion.classList.contains("open")) {
                                                        if (!isElementInViewport(accordion)) {
                                                            accordion.scrollIntoView({
                                                                behavior: "smooth",
                                                                block: "start"
                                                            });
                                                        }
                                                    }
                                                }, 300);
                                            });
                                        }

                                        accordion.addEventListener("transitionend", function () {
                                            if (accordion.scrollHeight > 0) {
                                                accordion.classList.add("open");
                                            } else {
                                                accordion.classList.remove("open");
                                            }
                                        });
                                    });
                                }

                                function isElementInViewport(el) {
                                    const rect = el.getBoundingClientRect();
                                    return (
                                        rect.top >= 0 &&
                                        rect.left >= 0 &&
                                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                                        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                                    );
                                }
                            });
                        </script>
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
                        <div class="h2 font-m font-weight-bolder text-blue">{{ __('pages.reviews') }}</div>
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
                                    <img src="{{ $page->pageBlocks->where('block', 'conditions')->where('key', 'image')->first()->imageUrl }}"
                                        alt="{{ $page->title ?? __('pages.surgery') }}">
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @forelse($page->pageBlocks->where('block', 'conditions')->where('key', 'image')->take(3) as $block)
                                @if ($loop->iteration !== 1)
                                    <div class="col-12 mb-5">
                                        <div class="stay-conditions--small-wrap">
                                            <a href="{{ $block->imageUrl }}" data-fancybox="stay-conditions--gallery">
                                                <div class="wrap-img">
                                                    <img src="{{ $block->imageUrl }}" alt="{{ ($page->title . $loop->iteration) ?? __('pages.surgery') }}">
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
                                                <img src="{{ $block->imageUrl }}" alt="{{ $page->title ?? __('pages.surgery') }}">
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
                                    <img src="{{ $page->pageBlocks->where('block', 'Inpatient')->where('key', 'image')->first()->imageUrl }}" alt="{{ $page->title ?? __('pages.surgery') }}">
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
                                                    <img src="{{ $block->imageUrl }}" alt="{{ $page->title ?? __('pages.surgery') }}">
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
                                                <img src="{{ $block->imageUrl }}" alt="{{ $page->title ?? __('pages.surgery') }}">
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

    @if(!empty($page->pageBlocks->where('block', '3d')->where('key', 'link')->first()->url ?? null))
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
    @endif
    <section class="any-questions mb-24 py-xl-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    <form id="form-any-questions" class="p-5 bg-white" autocomplete="off"
                    action="{{ route('feedback-question.store') }}">
                        @csrf
                        @method('POST')
                        <div class="h2 font-m font-weight-bolder mb-5">{{ __('web.do_you_have_any_questions') }}</div>
                        <div class="row field-wrap">
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-any-questions-name-2">{{ __('web.enter_your_full_name') }}</label>
                                    <input type="text" id="form-any-questions-name-2" name="name" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">{{ __('web.enter_your_full_name') }}</div>
                                </div>
                                <div id="name_error" class="field--help-info small-txt text-red mb-2"></div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-any-questions-phone-2">{{ __('web.enter_your_phone_number') }}</label>
                                    <input type="tel" id="form-any-questions-phone-2" name="phone" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">{{ __('web.enter_your_phone_number') }}</div>
                                </div>
                                <div id="phone_error" class="field--help-info small-txt text-red mb-2"></div>
                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-blue font-weight-bold w-100 mt-2">{{ __('web.make_an_appointment') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-5 col-lg-6 d-none d-lg-flex">
                    <div class="wrap-img">
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="{{ $page->title ?? __('pages.surgery') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($page->seo_title))
        <section class="seo mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="h2 font-weight-bolder text-blue mb-8">{{ $page->seo_title }}</h1>
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
