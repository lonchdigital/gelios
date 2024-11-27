@extends('site.layout.app')

@section('content')

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => trans('web.main'),
                'url' => route('main'),
            ],
            [
                'title' => $page->title,
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
                                <div class="h1 font-m font-weight-bolder mb-3">{{ trans('web.staczionar') }}</div>
                                <div class="h5 font-weight-bold">{{ trans('web.free_consultation') }}</div>
                            </div>
                        </div>
                        <div class="wrap-img">
                            <img class="bg-down" src="{{ asset('static_images/img-background-1.jpeg') }}" alt="img">
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
                            <img class="bg-down" src="img/img-251.jpeg" alt="img">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">2&nbsp;640</div>
                                <div class="h5 text-uppercase">Проведено операцій</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">14</div>
                                <div class="h5 text-uppercase">Років досвіду</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">24/7</div>
                                <div class="h5 text-uppercase">Ми поряд</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                <div class="quantity h2 font-m font-weight-bolder mb-2">100 000</div>
                                <div class="h5 text-uppercase">Відвідувань щороку</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="media-content">
        <div class="container">
            @include('site.components.text-section', ['data' => $pageTextBlock])
        </div>
    </section>

    <section class="hospitals-list mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordion-hospitals-list">
                        @php
                            $hospitalsIteration = 1;
                        @endphp
                        @foreach ($hospitals as $hospital)
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-hospitals-list-{{ $hospitalsIteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-hospitals-list-{{ $hospitalsIteration }}" aria-expanded="false"
                                            aria-controls="collapse-accordion-hospitals-list-{{ $hospitalsIteration }}">{{ $hospital->name }}
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-hospitals-list-{{ $hospitalsIteration }}" class="collapse"
                                    aria-labelledby="heading-accordion-hospitals-list-{{ $hospitalsIteration }}"
                                    data-parent="#accordion-hospitals-list">
                                    <div class="card-body media-content">
                                        <div class="row flex-column-reverse flex-lg-row">
                                            <div class="col-12">
                                                @include('site.components.text-section-hospital', ['data' => $hospital, 'iteration' => $hospitalsIteration])
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="media--swiper">
                                                            <div class="swiper-wrapper">
                                                                @foreach ($hospital->gallery as $oneImage)
                                                                    <div class="swiper-slide">
                                                                        <a href="{{ '/storage/' . $oneImage->image }}"
                                                                            data-fancybox="media--gallery-{{ $hospitalsIteration }}">
                                                                            <div class="wrap-img">
                                                                                <img src="{{ '/storage/' . $oneImage->image }}" alt="img">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="swiper-pagination mt-5 d-xl-none"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $hospitalsIteration++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

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

@endsection
