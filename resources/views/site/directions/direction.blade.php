@extends('site.layout.app')

@if (in_array($direction->id, [513, 104, 163, 495, 176, 463, 261, 271, 73]))
    @section('noindex')
        <meta name="robots" content="noindex, nofollow">
    @endsection
@endif

@section('head')
    @include('site.components.head', [
        'title' =>
            // $page->meta_title ?:
            (preg_match('/<h1\b[^>]*>(.*?)<\/h1>/is', $direction->textBlocks->where('number', 1)->first()->text_one, $m) ? strip_tags($m[1]) : $direction->name) . ' ' . __('web.direction_meta_title'),
        'description' =>
            // strip_tags($page->meta_description) ? $page->meta_description :
            (preg_match('/<h1\b[^>]*>(.*?)<\/h1>/is', $direction->textBlocks->where('number', 1)->first()->text_one, $m) ? strip_tags($m[1]) : $direction->name) . ' ' . __('web.direction_meta_description'),
        'url' => $url,
    ])
@endsection

@section('main_class', 'art-direction-template')

@section('content')

    {{-- @if (count($direction->infoBlocks) > 0)
        <script type="application/ld+json">
            {!! json_encode([
                "@context" => "https://schema.org",
                "@type" => "FAQPage",
                "mainEntity" => [
                    [
                        "@type" => "Question",
                        "name" => strip_tags($page->seo_title),
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => strip_tags($page->seo_text),
                        ],
                    ]
                ]
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @endif --}}

    @include('site.directions.partials.breadcrumbs', [
        'breadcrumbs' => $direction->buildBreadcrumbs(),
    ])

    <section class="section-top section-top-3 section-top-6 mb-24">
        <div class="container">
            @include('site.directions.partials.text-section-buttons', [
                'data' => $direction->textBlocks->where('number', 1)->first(),
                'alt' => $direction->name . ' ' . 1
                ]
            )
        </div>
    </section>

    <section class="direction-template mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-8 mb-24 mb-lg-0">
                    <div class="direction-template--inner rounded-sm p-md-6 mb-5 mb-lg-0">

                        <div class="row mb-5 mb-md-8">
                            <div class="col">
                                <div class="wrap-mob">
                                    <div class="h3 font-weight-bolder text-blue mb-8"></div>
                                    <div class="direction-template--content">
                                        @if(!is_null($direction->textBlocks->where('number', 2)->first()))
                                            {!! $direction->textBlocks->where('number', 2)->first()->text_one !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $textBlockThree = $direction->textBlocks->where('number', 3)->first();
                        @endphp
                        @if( !is_null($textBlockThree) )
                            <div class="media-content row mb-lg-8">
                                <div class="col">
                                    @include('site.components.text-section', [
                                        'data' => $textBlockThree,
                                        'mb' => 5,
                                        'alt' => $direction->name . ' ' . 3,
                                        ]
                                    )
                                </div>
                            </div>
                            @if($textBlockThree->button_one_url)
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{ $textBlockThree->button_one_url }}" class="btn btn-fz-20 btn-outline-blue font-weight-bold d-none d-lg-block">{{ trans('web.more_details') }}</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    {{-- <a href="##" class="btn btn-outline-blue font-weight-bold d-lg-none">{{ trans('web.more_details') }}</a> --}}
                </div>

                <div class="col-12 col-lg-5 col-xl-4">

                    @if( count($direction->children) > 0 )
                        <div class="bg-white rounded-sm p-3 p-md-6 mb-5">
                            <div class="h4 font-weight-bolder text-blue mb-3 ml-lg-3">{{ $direction->name ?? '' }}</div>
                            <div class="doctor-features-nav">
                                <ul class="nav">
                                    @foreach ($direction->children as $child)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url($child->buildFullPath()) }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="template-shares--swiper">
                        <div class="swiper-wrapper">
                            @foreach ($promotions as $promotion)
                                <div class="swiper-slide shares--item">
                                    <a href="{{ route('promotions.show', ['promotion' => $promotion->slug]) }}" class="inner">
                                        @if($promotion->image)
                                            <div class="wrap-img mb-4">
                                                <img src="{{ '/storage/' . $promotion->image }}" alt="img">
                                            </div>
                                        @endif
                                        <div class="h3 font-m text-white font-weight-bolder mb-4">{{ $promotion->title }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination mt-5"></div>
                        <div class="swiper-buttons d-none d-md-flex">
                            <div class="button-slider-prev">
                                <svg width="24.000000" height="24.000000" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <desc>
                                            Created with Pixso.
                                    </desc>
                                    <defs>
                                        <clipPath id="clip12_3808">
                                            <rect id="arrow-icon" width="24.000000" height="24.000000" fill="white" fill-opacity="0"/>
                                        </clipPath>
                                    </defs>
                                    <rect id="arrow-icon" width="24.000000" height="24.000000" fill="#FFFFFF" fill-opacity="0"/>
                                    <g clip-path="url(#clip12_3808)">
                                        <path id="Vector" d="M5 12L19 12" stroke="#EDEEF1" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
                                        <path id="Vector" d="M12 5L19 12L12 19" stroke="#EDEEF1" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="button-slider-next">
                                <svg width="24.000000" height="24.000000" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <desc>
                                            Created with Pixso.
                                    </desc>
                                    <defs>
                                        <clipPath id="clip12_3808">
                                            <rect id="arrow-icon" width="24.000000" height="24.000000" fill="white" fill-opacity="0"/>
                                        </clipPath>
                                    </defs>
                                    <rect id="arrow-icon" width="24.000000" height="24.000000" fill="#FFFFFF" fill-opacity="0"/>
                                    <g clip-path="url(#clip12_3808)">
                                        <path id="Vector" d="M5 12L19 12" stroke="#EDEEF1" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
                                        <path id="Vector" d="M12 5L19 12L12 19" stroke="#EDEEF1" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="media-content">
        <div class="container">
            @include('site.components.text-section', [
                'data' => $direction->textBlocks->where('number', 4)->first(),
                'alt' => $direction->name . ' ' . 4,
                ]
            )
            @include('site.components.text-section', [
                'data' => $direction->textBlocks->where('number', 5)->first(),
                'alt' => $direction->name . ' ' . 5,
                ]
            )
        </div>
    </section>

    @if( count($direction->prices) > 0 )
        <section class="prices-list mb-24">
            <div class="container">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <h2 class="h2 font-m font-weight-bolder text-blue">{{ trans('web.prices') }}</h2>
                    </div>
                </div>
                @forelse($direction->prices->sortBy('sort') as $price)
                    @include('site.components.price', ['price' => $price])
                @empty
                @endforelse
            </div>
        </section>
    @endif

    @if( count($doctors) > 0 )
        <section class="doctors mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <h2 class="h2 font-m font-weight-bolder text-blue">{{ trans('pages.doctors') }}</h2>
                        <a href="{{ route('doctors.index') }}" class="btn btn-white font-weight-bold">{{ trans('doctor.all_doctors') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="doctors--swiper">
                            <div class="swiper-wrapper">
                                @forelse($doctors as $doctor)
                                    @include('site.doctors.partials.doctor-swiper', ['doctor' => $doctor])
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

    @if( count($direction->infoBlocks) > 0 )
        <section class="how-consultation mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="h2 font-m font-weight-bolder text-blue mb-8">{{ trans('web.how_is_consultation_going') }}</h2>
                    </div>
                </div>
                <div class="row row-gap">
                    @forelse($direction->infoBlocks as $infoBlock)
                        @include('site.directions.partials.info-block', ['infoBlock' => $infoBlock])
                    @empty
                    @endforelse
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
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!isEmptyHtml($page->seo_text))
        <section class="seo mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @if($page->seo_title)
                            <h2 class="h2 font-weight-bolder text-blue mb-8">{{ $page->seo_title }}</h2>
                        @endif
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
