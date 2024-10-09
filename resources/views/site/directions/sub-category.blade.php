@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => '22222222222222',
                'url' => route('doctors.index'),
            ],
            [
                'title' => $direction->name ?? '',
                'url' => null,
            ],
        ],
    ])

    <section class="section-top section-top-3 section-top-6 mb-24">
        <div class="container">
            @include('site.directions.partials.text-section-buttons', ['data' => $direction->textBlocks->where('number', 1)->first()])
        </div>
    </section>

    <section class="doctor-features mb-24">
        <div class="container">
            <div class="row">
                @include('site.directions.partials.text-section-narrow', ['data' => $direction->textBlocks->where('number', 2)->first()])
                <div class="col-12 col-md-6 col-xl-4">
                    <div id="doctor-features--inner-2" class="bg-white rounded-sm p-3 p-md-6">
                        <div class="h3 font-weight-bolder text-blue mb-8 mb-md-2 ml-md-3">{{ $direction->name ?? '' }}</div>
                        <div class="doctor-features-nav">
                            <ul class="nav">
                                @foreach ($direction->children as $child)
                                    <li class="nav-item">
                                        @if ($child->template === 1)
                                            <a class="nav-link" href="{{ route('direction.category', ['pageDirection' => $child->page->slug]) }}">
                                                {{ $child->name }}
                                            </a>
                                        @elseif ($child->template === 2)
                                            <a class="nav-link" href="{{ route('direction.sub-category', ['pageDirection' => $child->page->slug]) }}">
                                                {{ $child->name }}
                                            </a>
                                        @elseif ($child->template === 3)
                                            <a class="nav-link" href="{{ route('direction.itself', ['pageDirection' => $child->page->slug]) }}">
                                                {{ $child->name }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if( count($doctors) > 0 )
        <section class="doctors mb-24">
            <div class="container overflow-hidden">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder text-blue">Лікарі</div>
                        <a href="##" class="btn btn-white font-weight-bold">Усі лікарі</a>
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
                        <div class="h2 font-m font-weight-bolder text-blue">Ціни</div>
                    </div>
                </div>
                @forelse($direction->prices as $price)
                    @include('site.directions.partials.price', ['price' => $price])
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
                        <div class="h2 font-m font-weight-bolder text-blue mb-8">Як проходить консультація?</div>
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
                        <img src="{{ asset('styles/img/img-right-b.png') }}" alt="img">
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
                        <div class="h2 font-weight-bolder text-blue mb-8">SEO</div>
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
