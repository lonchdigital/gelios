@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => ($doctor->title) . ($seo[0] ?? $page->meta_title ?: $page->title),
        'description' => $seo[1] ?? $page->meta_description,
        'url' => $url
    ])
@endsection

@section('content')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Physician",
            "name": "{{ $doctor->name }}",
            "specialization": "{{ $doctor->specialty }}",
            "qualification": "{{ $doctor->education }}",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "{{ $doctor->city ?? '' }}",
                "streetAddress": "{{ $doctor->address ?? '' }}"
            },
            "image": "{{ $doctor->imageUrl }}"
        }
    </script>

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => __('web.main'),
                'url' => route('main'),
            ],
            [
                'title' => $page->title,
                'url' => route('doctors.index'),
            ],
            [
                'title' => $doctor->title ?? '',
                'url' => null,
            ],
        ],
    ])
    <section class="section-doctor mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                    <div class="wrap-img">
                        <img class="bg-down" src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="doctor-descrp">
                        <div class="row mb-1">
                            <div class="col-8">
                                <div class="h3 font-m font-weight-bolder text-blue">{{ $doctor->title ?? '' }}</div>
                            </div>
                        </div>
                        <div class="position-work font-weight-bold text-grey mb-3">{{ __('doctor.doctor') }}
                            {{ $doctor->specialization->title ?? '' }}</div>

                        @if(!empty($doctor->expirience))
                            <div class="experience-quantity mb-3">{{ __('doctor.work_experience') }}: {{ $doctor->expirience ?? '' }} років</div>
                        @endif

                        <div class="os-scrollbar-overflow content mb-3">
                            @if($doctor->specialty)
                                <div class="mb-3">
                                    <span
                                        class="text-blue mr-3">{{ __('doctor.specialty') }}:</span><span>{{ $doctor->specialty ?? '' }}</span>
                                </div>
                            @endif
                            @if($doctor->specializations->count())
                                <div class="mb-3">
                                    <span
                                        class="text-blue mr-3">{{ __('doctor.specialization') }}:</span>
                                        {{-- <span>{{ $doctor->specialization->title ?? '' }}</span> --}}
                                        @forelse ($doctor->specializations as $specialization)
                                            <span>{{ $specialization->title ?? '' }}</span>@if(!$loop->last),@endif
                                        @empty
                                        @endforelse
                                </div>
                            @endif
                            @if(!empty($doctor->age))
                                <div class="mb-3">
                                    <span class="text-blue mr-3">{{ __('doctor.doctor_experience') }}:</span><span>{{ $doctor->age ?? '' }} роки</span>
                                </div>
                            @endif
                            <div class="mb-3">
                                <span class="text-blue mr-3">{{ __('doctor.education') }}:</span><span>{!! $doctor->education !!}</span>
                            </div>
                            {!! $doctor->content !!}
                            {{-- <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>2006-2011 Зав. терапевтичного відділення МКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2012 Зав. приймального відділення КЗДМКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>2006-2011 Зав. терапевтичного відділення МКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2012 Зав. приймального відділення КЗДМКЛ №11 в м. Дніпропетровськ</p>
                            <p>2012-2019 Зав. терапевтичного відділення КЗДМКЛ №11 м. Дніпро</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p> --}}
                        </div>
                        @if(count($doctor->directions))
                        <div class="text-blue font-weight-bold mb-2">{{ __('doctor.directions_of_treatment') }}:</div>
                            <div class="doctor-directions-list font-weight-bold mb-4">
                                @forelse($doctor->directions as $direction)
                                    <div class="item">{{ $direction->name }}</div>
                                @empty
                                @endforelse
                            </div>
                        @endif
                        <button type="button" class="btn btn-blue font-weight-bold" data-toggle="modal"
                        data-target="#popup--sign-up-appointment">{{ __('pages.make_an_appointment') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(count($doctor->imagesUrl))
        <section class="certificates mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder text-blue">{{ __('doctor.diplomas_and_certificates') }}</div>
                    </div>
                </div>
                <div class="certificates--swiper">
                    <div class="swiper-wrapper mb-8">
                        @forelse($doctor->imagesUrl as $image)
                            <div class="certificates--item swiper-slide">
                                <a data-fancybox="certificates--gallery" href="{{ $image }}">
                                    <div class="inner">
                                        <div class="wrap-img">
                                            <img src="{{ $image }}" alt="{{ $doctor->title ?? '' }}">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    @if( count($reviews) > 0 )
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
    <section class="news news-doctor mb-24">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col d-flex align-items-center justify-content-between mb-5">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ __('pages.news') }}</div>
                    <a href="{{ route('articles.index') }}" class="btn btn-white font-weight-bold">{{ __('pages.all_news') }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="news--swiper">
                        <div class="swiper-wrapper">
                            @forelse($relatedArticles as $relatedArticle)
                                <div class="swiper-slide news--item">
                                    <a href="{{ route('articles.show', ['slug' => $relatedArticle->slug]) }}" class="inner">
                                        <div class="wrap-img mb-4">
                                            <img src="{{ $relatedArticle->imageUrl }}" alt="{{ $relatedArticle->title }}">
                                            <div class="date-label">{{ Carbon\Carbon::parse($relatedArticle->created_at)->day }}  {{ Carbon\Carbon::parse($relatedArticle->created_at)->translatedFormat('F') }} {{ Carbon\Carbon::parse($relatedArticle->created_at)->year }}</div>
                                        </div>
                                        <div class="h3 small mb-2">{{ $relatedArticle->title }}</div>
                                        <div class="descrp">{!! $relatedArticle->description !!}</div>
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
@endsection
