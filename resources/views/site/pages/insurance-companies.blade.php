@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title . ' ' . __('web.direction_meta_title'),
        'description' => $page->meta_description ?: $page->title . ' ' . __('web.direction_meta_description'),
        'url' => $url,
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])

    <section class="partners-top mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                        <div class="backdrop p-3 px-lg-6 py-lg-12">
                            <div class="row">
                                <div class="col col-lg-6">
                                    <div class="content pt-34 mt-16 pt-lg-0 mt-lg-0">
                                        <h1 class="h2 font-m font-weight-bolder mb-5">{{ $page->sub_title }}</h1>
                                        <div class="h6 font-m font-weight-bold">{!! $pageTextBlock->text_one !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-img">
                            <img class="bg-down" src="{{ '/storage/' . $pageTextBlock->image }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partners mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 text-blue font-m font-weight-bolder mb-8">{{ trans('web.companies_we_are_working_with') }}</div>
                </div>
            </div>
        </div>
        <div class="partners--swiper mb-8">
            <div class="swiper-wrapper">
                @foreach ($companiesRowOne as $conpanyRowOne)
                    <div class="swiper-slide">
                        <div class="content">
                            <div class="wrap-img">
                                <img src="{{ '/storage/' . $conpanyRowOne->image }}" alt="img">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div dir="rtl" class="partners--swiper">
            <div class="swiper-wrapper">
                @foreach ($companiesRowTwo as $conpanyRowTwo)
                    <div class="swiper-slide">
                        <div class="content">
                            <div class="wrap-img">
                                <img src="{{ '/storage/' . $conpanyRowTwo->image }}" alt="img">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="partners-contacts mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white bg-blue">
                        <div class="p-3 px-lg-6 py-lg-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-4">
                                    <div class="content">
                                        <div class="h3 font-weight-bolder mb-5">{{ $page->description }}</div>
                                        <ul class="list-inline mb-5 d-flex flex-column">

                                            @foreach($phones as $phone)
                                                <li class="list-inline-item">
                                                    <a href="tel:{{ $phone->item }}">
                                                        <div class="link-phone">{{ $phone->item }}</div>
                                                    </a>
                                                </li>
                                            @endforeach

                                            {{-- <li class="list-inline-item">
                                                <button type="button" class="contact-details" data-toggle="modal"
                                                    data-target="#popup--contacts">{{ trans('web.view') }}</button>
                                            </li> --}}
                                        </ul>
                                        <div class="descrp h5">{{ trans('web.will_be_happy_to_work') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="wrap-img mb-4 mb-lg-0">
                                            <img src="{{ asset('static_images/logo-without-name.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
