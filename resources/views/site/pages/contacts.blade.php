@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])


    <section class="mb-8">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row mb-8">
                        <div class="col d-flex align-items-center justify-content-between">
                            <div class="h2 font-m font-weight-bolder text-blue">Контакти</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="search">
                        <div class="input-search">
                            <input type="search" class="search-input" placeholder="Введіть назву міста / вулиці">
                            <button type="button" class="search-icon btn p-0"></button>
                        </div>
                        <div class="results-search"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contacts mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row row-gap">
                        @foreach ($contacts as $contact)
                            <div class="col-12 col-md-6">
                                <div class="offices--item">
                                    <div class="map-body h-100 rounded-top overflow-hidden">
                                        <div class="wrap-img h-100">
                                            <div class="map">
                                                {!! $contact->iframe !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner">
                                        <div class="row">
                                            <div class="col-12 col-xl-auto mb-3 mb-xl-0">
                                                <div class="wrap-img">
                                                    <img src="{{ '/storage/' . $contact->image }}" alt="img">
                                                    <div class="city-label">{{ $contact->city }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl ml-xl-n2">
                                                <div class="city-pin mb-3 mt-xl-1">{{ $contact->city }}, <br>{{ $contact->street }}</div>
                                                @foreach ($contact->items->where('type', 'email') as $email)
                                                    <div class="email mb-3"><a href="mailto:{{ $email->item }}">{{ $email->item }}</a></div>
                                                @endforeach
                                                @foreach ($contact->items->where('type', 'phone') as $phone)
                                                    <div class="phone mb-2"><a href="tel{{ $phone->item }}">{{ $phone->item }}</a></div>
                                                @endforeach
                                                
                                                <div class="buttons d-flex flex-wrap">
                                                    <a href="##" class="btn btn-fz-20 btn-blue font-weight-bold w-100">Записатись на прийом</a>
                                                    <a href="##" class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Прокласти маршрут</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
