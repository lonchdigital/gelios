@extends('site.layout.app')

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

    {{-- @if (!isEmptyHtml($page->seo_text))
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
                'alt' => $direction->name . ' ' . 1,
                ]
            )
        </div>
    </section>

    <section class="doctor-features mb-24">
        @php
            $hasChildren = count($direction->children) > 0;
        @endphp
        <div class="container">
            <div class="row align-items-stretch">
                @include('site.directions.partials.text-section-narrow', [
                    'data' => $direction->textBlocks->where('number', 2)->first(),
                    'hasChildren' => $hasChildren,
                    'alt' => $direction->name . ' ' . 2,
                    ]
                )
                @if( $hasChildren )
                    <div class="col-12 col-md-6 col-xl-4">
                        <div id="doctor-features--inner-2" class="bg-white rounded-sm p-3 p-md-6 min-h-narrow-block">
                            <div class="h3 font-weight-bolder text-blue mb-8 mb-md-2 ml-md-3">{{ $direction->name ?? '' }}</div>
                            <div class="content rich-text-block os-scrollbar-overflow">

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
                        </div>
                    </div>
                @else
                    <div id="doctor-features--inner-2" class="bg-white rounded-sm p-3 p-md-6 d-none"></div>
                @endif
            </div>
        </div>
    </section>

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

    @if( count($direction->prices) > 0 )
        <section class="prices-list mb-24">
            <div class="container">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <h2 class="h2 font-m font-weight-bolder text-blue">{{ trans('pages.prices') }}</h2>
                    </div>
                </div>
                @forelse($direction->prices->sortBy('sort') as $price)
                    @include('site.components.price', ['price' => $price])
                @empty
                @endforelse
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
