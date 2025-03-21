@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url,
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => trans('web.main'),
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])


    <section class="offices-top mb-8">
        <div class="container">
            <div class="row mb-8">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ $page->title ?? '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col position-static">
                    <div class="offices--swiper--wrapper position-relative">
                        <div class="offices-anchor--swiper">
                            <div class="swiper-wrapper">
                                @foreach ($contacts as $contact)
                                    <div class="swiper-slide">
                                        <a href="#office-{{ $contact->id }}" class="anchor">
                                            <div class="city-pin">{{ $contact->city }}, {!! '<br>' . $contact->street !!}</div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-buttons d-flex">
                                <div class="button-slider-prev">
                                    <svg>
                                        <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-right' }}"></use>
                                    </svg>
                                </div>
                                <div class="button-slider-next">
                                    <svg>
                                        <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-right' }}"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offices-direction mb-24 mb-lg-0">
        @foreach ($contacts as $contact)
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org/",
                    "@type": "Product",
                    "name": "{{ $contact->title }}",
                    "description": "{{ $contact->description }}",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "{{ $contact->street }}",
                        "addressLocality": "{{ $contact->city }}",
                        "postalCode": "індекс",
                        "addressRegion": "область",
                        "addressCountry": "Україна"
                    },
                    @if(!empty($contact->items->where('type', 'phone')->first()->title))
                        "telephone": "{{ $contact->items->where('type', 'phone')->first()->title }}",
                    @endif
                    @if(!empty($contact->items->where('type', 'email')->first()->title))
                        "email": "{{ $contact->items->where('type', 'email')->first()->title }}",
                    @endif
                    "openingHours": "Графік роботи",
                    "medicalSpecialty": "спеціалізація клініки, наприклад Багатопрофільний медичний центр",
                    @if(!empty($contact->image))
                        "image": "{{ '/storage/' . $contact->image }}",
                    @endif
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": широта,
                        "longitude": довгота
                    },
                    "hasMap": "{{ $contact->map_url }}",
                    "priceRange": "",
                    "sameAs": [
                        "http://facebook.com/medicalcenter",
                        "http://twitter.com/medicalcenter",
                        "http://instagram.com/medicalcenter"
                    ]
                }
            </script>

            {{-- @dd($contact->getDirectionsTree()) --}}
            @php
                $contactTteration = $loop->iteration;
            @endphp
            <div class="offices-direction--item py-12 bg-white mb-8" id="office-{{ $contact->id }}">
                <div class="container">
                    <div class="offices-direction--content">
                        <div class="row">
                            <div class="col">
                                <div class="push-menu">
                                    <div class="push-menu--nav">
                                        <div class="nav-toggle">
                                            <a href="##" class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>{{ trans('web.back') }}</span>
                                                <span class="icon"></span>
                                            </a>
                                            <a href="##" class="btn-nav-forward btn-nav-direction btn font-weight-bold ml-auto mb-6">
                                                <span>{{ trans('web.all_directions') }}</span><span class="icon"></span>
                                            </a>
                                        </div>
                                        <div class="push-menu--lvl position-relative">
                                            <div class="item has-dropdown">
                                                <div class="row offices-direction--body">
                                                    <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                                                        <div class="position-relative">
                                                            <!-- main slider -->
                                                            <div class="offices-direction--swiper">
                                                                <div class="swiper-wrapper">
                                                                    @foreach ($contact->gallery as $galleryItem)
                                                                        <div class="swiper-slide">
                                                                            <a href="{{ '/storage/' . $galleryItem->image }}"
                                                                                data-fancybox="offices-direction--gallery-{{ $contactTteration }}">
                                                                                <div class="wrap-img">
                                                                                    <img src="{{ '/storage/' . $galleryItem->image }}" alt="img">
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="swiper-buttons d-flex">
                                                                    <div class="button-slider-prev">
                                                                        <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <desc>
                                                                                    Created with Pixso.
                                                                            </desc>
                                                                            <defs>
                                                                                <clipPath id="clip12_24291">
                                                                                    <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                                                                                </clipPath>
                                                                            </defs>
                                                                            <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                                                                            <g clip-path="url(#clip12_24291)">
                                                                                <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="button-slider-next">
                                                                        <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <desc>
                                                                                    Created with Pixso.
                                                                            </desc>
                                                                            <defs>
                                                                                <clipPath id="clip12_24291">
                                                                                    <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                                                                                </clipPath>
                                                                            </defs>
                                                                            <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                                                                            <g clip-path="url(#clip12_24291)">
                                                                                <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- thumbs slider -->
                                                            <div class="offices-direction-thumbs--swiper">
                                                                <div class="swiper-wrapper">
                                                                    @foreach ($contact->gallery as $galleryItem)
                                                                        <div class="swiper-slide">
                                                                            <div class="wrap-img">
                                                                                <img src="{{ '/storage/' . $galleryItem->image }}" alt="img">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4  mb-5 mb-lg-0">
                                                        <div
                                                            class="offices-direction--descrp d-flex flex-column justify-content-between h-100">
                                                            <div class="h3 font-weight-bolder mb-5">{{ $contact->title }}</div>
                                                            <p class="mb-5 mb-lg-8">{!! $contact->text !!}</p>
                                                            <a href="##" class="btn btn-blue font-weight-bold px-xl-14"
                                                                data-toggle="modal"
                                                                data-target="#popup--sign-up-appointment">{{ trans('web.make_appointment') }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="offices-direction--contact">
                                                            <div class="city-pin mb-2">{{ $contact->city }}, {{ $contact->street }}</div>
                                                            @foreach ($contact->items->where('type', 'email') as $email)
                                                                <div class="email mb-2">
                                                                    <a href="mailto:{{ $email->item }}">{{ $email->item }}</a>
                                                                </div>
                                                            @endforeach
                                                            @foreach ($contact->items->where('type', 'phone') as $phone)
                                                                <div class="phone mb-2"><a href="tel:{{ $phone->item }}">{{ $phone->item }}</a></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="push-menu--lvl">
                                                    <div class="item has-dropdown">
                                                        <div class="category-directions">
                                                            <div class="category-directions--list ">
                                                                <div class="row">
                                                                    @foreach ($contact->getDirectionsTree() as $item)
                                                                        <div class="col-12 col-lg-4 col-xl-3 position-static">
                                                                            @if( $item['children'] )
                                                                                <div class="directions-item">
                                                                                    <div class="content item has-dropdown">
                                                                                        <a href="##" class="link">
                                                                                            <span>{{ $item['name'] }}</span>
                                                                                            <div class="i-link"></div>
                                                                                        </a>
                                                                                        <x-site.directions.section-menu :data="$item['children']" />
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="directions-item">
                                                                                    <div class="content">
                                                                                        <a class="link" href="{{ $item['full_path'] }}">
                                                                                            {{ $item['name'] }}
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

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
@endsection
