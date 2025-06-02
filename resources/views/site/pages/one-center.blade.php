@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
            'title' => $page->meta_title ?: $page->title,
            'description' => $page->meta_description,
            'url' => $url,
        ])

    {{-- @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
    ]) --}}
@endsection

@section('content')
    {{-- <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "MedicalOrganization",
            "name": "{{ $page->title ?? '' }}",
            "description": "{{ $slides->first()->description ?? '' }}",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "",
              "addressLocality": "",
              "postalCode": "",
              "addressRegion": "",
              "addressCountry": ""
            },
            "telephone": "",
            "email": "",
            "openingHours": "",
            "medicalSpecialty": "{{ $page->title ?? '' }}",
            "image": "{{ config('app.url') . '/storage/' . $slides->first()->image }}",
            "geo": {
              "@type": "GeoCoordinates",
              "latitude": "",
              "longitude": ""
            },
            "hasMap": "",
            "priceRange": "",
            "sameAs": [
            ]
        }
    </script> --}}

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])

    <section class="section-top section-top-5 mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-top--backdrop-swiper overflow-hidden h-100 position-relative">
                        <div class="swiper-wrapper">

                            @foreach ($slides as $slide)
                                <div class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                    <div class="backdrop px-3 pt-3 pb-10 p-sm-3 p-lg-6">
                                        <div class="content">
                                            <h1 class="h1 font-m font-weight-bolder mb-3">{{ $slide->title }}</h1>
                                            <div class="h5 font-m font-weight-bold mb-3">{{ $slide->description }}</div>
                                            <a data-toggle="modal"
                                                data-target="#popup--sign-up-appointment"
                                                class="btn btn-white font-weight-bold">{{ trans('pages.sign_up_for_for_appointment') }}</a>
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        <img class="bg-down" src="{{ '/storage/' . $slide->image }}" alt="img">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-directions mb-24">
        <div class="container">
            <div class="row mb-8">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ trans('web.directions') }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="section-directions--list">
                        @foreach ($briefBlocks as $briefBlock)
                            <div class="item">
                                <a href="{{ $briefBlock->url ?? '' }}">
                                    <div class="item--body">
                                        <div class="mb-2 mb-lg-4">
                                            <img src="{{ '/storage/' . $briefBlock->image }}" alt="icon">
                                        </div>
                                        <div class="name font-m h5">{{ $briefBlock->title }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="media-content">
        <div class="container">
            @include('site.components.text-section', ['data' => $pageTextBlockOne])
        </div>
    </section>

    @if($page->video_file)
        <section class="section-video mb-24">
            <div class="video-wrap">
                <video class="js-player specific-player" playsinline controls data-poster="img/tour.jpeg">
                    <source src="{{ '/storage/' . $page->video_file }}" type="video/mp4" />
                </video>
            </div>
        </section>
    @endif

    <section class="media-content">
        <div class="container">
            @include('site.components.text-section', ['data' => $pageTextBlockTwo])
        </div>
    </section>
    @if( count($doctors) > 0 )
        <section class="doctors mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder text-blue">{{ trans('pages.doctors') }}</div>
                        <a class="btn btn-white font-weight-bold">{{ trans('pages.all_doctors') }}</a>
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
    @if (!isEmptyHtml($page->seo_text))
        <section class="seo mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="h2 font-weight-bolder text-blue mb-8">{{ $page->seo_title }}</div>
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
