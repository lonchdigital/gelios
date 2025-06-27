@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url,
    ])
@endsection

@section('content')
    {{-- @forelse($affiliates as $affiliate)
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "MedicalOrganization",
                "name": "{{ $affiliate->address ?? '' }}",
                "description": "{{ ($affiliate->address ?? '') . ' ' . ($affiliate->first_phone ?? '') }}",
                "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $affiliate->address ?? '' }}",
                "addressLocality": "",
                "postalCode": "",
                "addressRegion": "",
                "addressCountry": ""
                },
                "telephone": "{{ $affiliate->first_phone ?? '' }}",
                "email": "{{ $affiliate->email ?? '' }}",
                "openingHours": "{{ $affiliate->hours ?? '' }}",
                "medicalSpecialty": "{{ $page->title ?? '' }}",
                "image": "",
                "geo": {
                "@type": "GeoCoordinates",
                "latitude": "{{ $affiliate->latitude ?? '' }}",
                "longitude": "{{ $affiliate->longitude ?? '' }}"
                },
                "hasMap": "",
                "priceRange": "",
                "sameAs": [
                ]
            }
        </script>
    @empty
    @endforelse --}}
    <script type="application/ld+json">
        {!! json_encode([
            "@context" => "http://schema.org",
            "@type" => "MedicalOrganization",
            "name" => "Центр хірургії та реабілітації 'Геліос'",
            "description" => $page->description ?? '',
            "address" => $affiliates->map(function($affiliate) {
                return [
                    "@type" => "PostalAddress",
                    "streetAddress" => $affiliate->address ?? '',
                    "addressLocality" => $affiliate->city ?? 'Дніпро',
                    "postalCode" => $affiliate->postal_code ?? '50000',
                    "addressRegion" => $affiliate->region ?? 'Дніпропетровська область',
                    "addressCountry" => $affiliate->country ?? 'UA',
                    "telephone" => array_filter([
                        $affiliate->first_phone,
                        $affiliate->second_phone,
                    ])
                ];
            })->toArray(),
            "email" => $affiliates->first()?->email ?? '',
            "openingHours" => $affiliates->first()?->hours ?? '',
            "medicalSpecialty" => $page->title ?? 'Багатопрофільний медичний центр',
            "image" => $page->image_url ?? 'http://example.com/medicalcenter.jpg',
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => $affiliates->first()?->latitude ?? '',
                "longitude" => $affiliates->first()?->longitude ?? '',
            ],
            "hasMap" => $affiliates->first()?->map_url ?? 'https://goo.gl/maps/your-location',
            "priceRange" => '',
            "sameAs" => [
                "http://facebook.com/medicalcenter",
                "http://twitter.com/medicalcenter",
                "http://instagram.com/medicalcenter"
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    {{-- <main class="main"> --}}
        <section class="section-top mb-24 mt-8">
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
                                            @if(!empty($slide->image))
                                                <img class="bg-down" src="{{ $slide->imageUrl }}" alt="{{ $slide->title }}">
                                            @else
                                                <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}" alt="{{ $slide->title }}">
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 col-xxl-4">
                        <div class="row flex-row flex-lg-column">
                            <div class="col-12 col-md-6 col-lg-12 mb-4 mb-md-0 mb-lg-5">
                                <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                    <div class="backdrop-small align-content-end d-flex align-items-end p-3 p-lg-6 ">
                                        <div class="h4 font-weight-bolder mb-2">
                                            {!! $page->pageBlocks->where('block', 'main')->where('key', 'second')->first()->title ?? 'Підпиши <br>декларацію <br>за 5 хвилин' !!}
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        @if(!empty($page->pageBlocks->where('block', 'main')->where('key', 'second')->first()->image))
                                            <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'main')->where('key', 'second')->first()->imageUrl }}"
                                                alt="{!! $page->pageBlocks->where('block', 'main')->where('key', 'second')->first()->title ?? 'Підпиши <br>декларацію <br>за 5 хвилин' !!}">
                                        @else
                                            <img class="bg-down" src="{{ asset('static_images/img-79.jpeg') }}" alt="img">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12">
                                <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                    <div class="backdrop-small text-right p-3 p-lg-6">
                                        <div class="h4 font-weight-bolder">
                                            {!! $page->pageBlocks->where('block', 'main')->where('key', 'third')->first()->title ?? 'Підпиши <br>декларацію <br>за 5 хвилин' !!}
                                    </div>
                                    <div class="wrap-img">
                                        @if(!empty($page->pageBlocks->where('block', 'main')->where('key', 'third')->first()->image))
                                            <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'main')->where('key', 'third')->first()->imageUrl }}"
                                                alt="{!! $page->pageBlocks->where('block', 'main')->where('key', 'third')->first()->title ?? 'Підпиши <br>декларацію <br>за 5 хвилин' !!}">
                                        @else
                                            <img class="bg-down" src="{{ asset('static_images/img-77.jpeg') }}" alt="img">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('site.components.section-progress', ['page' => $page, 'block' => 'second'])

        @include('site.directions.partials.our-directions-section')

        <section class="shares mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder">{{ __('pages.promotions') }}</div>
                        <a href="{{ route('promotions.index') }}" class="h5 btn btn-white font-weight-bold">{{ __('pages.all_promotions') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="shares--swiper">
                            <div class="swiper-wrapper">
                                @forelse($promotions as $promotion)
                                    <div class="swiper-slide shares--item">
                                        <a href="{{ route('promotions.show', ['promotion' => $promotion->slug]) }}" class="inner">
                                            <div class="wrap-img mb-4">
                                                <img src="{{ $promotion->imageUrl }}" alt="{{ $promotion->title }}">
                                            </div>
                                            <div class="h3 small font-m">
                                                {!! $promotion->title !!}
                                                {{-- Скористайтеся нашим осіннім обстеженням <div
                                                    class="underline">зі знижкою 15%!</div> --}}
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="swiper-pagination mt-2 d-xl-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-us mb-24">
            <div class="container-max position-relative overflow-hidden mx-auto">
                <div class="container">
                    <div class="row pt-16  pb-6 py-lg-16 text-white">
                        <div class="col col-md-8 col-xl-4">
                            <div class="content">
                                <h1 class="h2 font-m font-weight-bolder mb-3 mb-lg-5">
                                    {!! $page->pageBlocks->where('block', 'banner')->first()->title ?? '' !!}
                                </h1>
                                <div class="h5 font-weight-bold mb-8 mb-lg-10">
                                    {!! $page->pageBlocks->where('block', 'banner')->first()->description ?? '' !!}
                                </div>
                                <a href="{{ $page->pageBlocks->where('block', 'banner')->first()->url ?? '##' }}" class="btn btn-white font-weight-bold">
                                    {{ $page->pageBlocks->where('block', 'banner')->first()->button ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-img">
                    @if(!empty($page->pageBlocks->where('block', 'banner')->first()->image))
                        <img class="bg-down" src="{{ $page->pageBlocks->where('block', 'banner')->first()->imageUrl ?? asset('/static_images/img-background-2.jpeg') }}"
                            alt="{!! $page->pageBlocks->where('block', 'banner')->first()->title ?? '' !!}">
                    @else
                        <img class="bg-down" src="{{ asset('/static_images/img-background-2.jpeg') }}"
                            alt="{!! $page->pageBlocks->where('block', 'banner')->first()->title ?? '' !!}">
                    @endif
                </div>
            </div>
        </section>
        <section class="doctors mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder">{{ __('pages.doctors') }}</div>
                        <a href="{{ route('doctors.index') }}" class="h5 btn btn-white font-weight-bold">{{ __('pages.all_doctors') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="doctors--swiper">
                            <div class="swiper-wrapper">
                                @forelse($doctors as $doctor)
                                    <div class="doctors--item swiper-slide">
                                        <a href="{{ route('doctors.show', ['doctor' => $doctor->slug ?? $doctor->id]) }}" class="inner">
                                            <div class="wrap-img mb-3">
                                                <img src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
                                            </div>
                                            @if($doctor->age)
                                                <div class="experience-quantity mb-3"> {{ trans('doctor.work_experience') . ' ' . $doctor->getAgeWithWord() ?? '' }}</div>
                                            @endif
                                            <div class="h4 mb-1 font-weight-bolder">{{ $doctor->title }}</div>
                                            <div class="position-work">{{ $doctor->specialty }}</div>
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

        <section class="meeting mb-24 py-lg-16">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-7 col-lg-6">
                        @include('site.components.appointment-form', ['id' => 1])
                    </div>
                    <div class="col-5 col-lg-6 d-none d-lg-flex">
                        <div class="wrap-img">
                            <img src="{{ asset('static_images/img-right-b.png') }}" alt="{{ 'Геліос' }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="offices mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder">{{ trans('web.our_offices') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="offices--swiper">
                            <div class="swiper-wrapper">
                                @foreach ($contacts as $contact)
                                    @include('site.components.office-swiper', ['contact' => $contact])
                                @endforeach
                            </div>
                            <div class="swiper-pagination mt-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        <section class="partners mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="h2 font-m font-weight-bolder text-lg-center mb-8">{{ trans('web.insurance_companies_we_are_working_with') }}</div>
                    </div>
                </div>
            </div>
            @if($insuranceCompanies->where('row', 1)->count())
                <div class="partners--swiper mb-8">
                    <div class="swiper-wrapper">
                        @foreach ($insuranceCompanies->where('row', 1)->sortBy('sort') as $company)
                            <div class="swiper-slide">
                                <div class="content">
                                    <div class="wrap-img">
                                        <img src="{{ '/storage/' . $company->image }}" alt="img">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($insuranceCompanies->where('row', 2)->count())
                <div dir="rtl" class="partners--swiper">
                    <div class="swiper-wrapper">
                        @foreach ($insuranceCompanies->where('row', 2)->sortBy('sort') as $company2)
                            <div class="swiper-slide">
                                <div class="content">
                                    <div class="wrap-img">
                                        <img src="{{ '/storage/' . $company2->image }}" alt="img">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
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
        <section class="meeting mb-24 py-lg-16">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-7 col-lg-6">
                        {{-- <form id="form-meeting-2" class="p-3 p-lg-5 bg-white">
                            <div class="h2 font-m font-weight-bolder mb-5">Записатися на прийом</div>
                            <div class="row field-wrap">
                                <div class="col-12">
                                    <div class="field mb-2">
                                        <label class="control-label mb-2" for="form-meeting-name-2">Вкажіть ПІБ</label>
                                        <input type="text" id="form-meeting-name-2" class="form-control mb-2">
                                        <div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field mb-2">
                                        <label class="control-label mb-2" for="form-meeting-phone-2">Вкажіть номер
                                            телефону</label>
                                        <input type="tel" id="form-meeting-phone-2" class="form-control mb-2">
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
                        </form> --}}
                        @include('site.components.appointment-form', ['id' => 2])
                    </div>
                    <div class="col-5 col-lg-6 d-none d-lg-flex">
                        <div class="wrap-img">
                            <img src="{{ asset('static_images/img-right-b.png') }}" alt="{{ 'Геліос' }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(!empty($page->seo_title))
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

    {{-- </main> --}}
@endsection
