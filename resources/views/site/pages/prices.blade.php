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
                            <div class="h2 font-m font-weight-bolder text-blue">Ціни</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="search">
                        <div class="input-search">
                            <input type="search" class="search-input" placeholder="Пошук по адресі">
                            <button type="button" class="search-icon btn p-0"></button>
                        </div>
                        <div class="results-search"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prices-list mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordion-prices-list">
                        @foreach ($page->tests as $test)
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-prices-list-{{ $loop->iteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse-accordion-prices-list-{{ $loop->iteration }}">{{ $test->title }}</div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-prices-list-{{ $loop->iteration }}" class="collapse" aria-labelledby="heading-accordion-prices-list-{{ $loop->iteration }}" data-parent="#accordion-prices-list">
                                    <div class="card-body">
                                        @foreach ($test->prices as $price)
                                            @include('site.components.price', ['price' => $price])
                                        @endforeach
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
                        <img src="{{ asset('styles/img/img-right-b.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
