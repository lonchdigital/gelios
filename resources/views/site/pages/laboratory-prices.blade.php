@extends('site.layout.app')

@section('head')
    @vite(['resources/js/filters/prices/pricesFilter.js'])
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

    <section class="mb-8">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row mb-8">
                        <div class="col d-flex align-items-center justify-content-between">
                            <div class="h2 font-m font-weight-bolder text-blue">{{ $page->title ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="search">
                        <div class="input-search">
                            <input id="laboratories-search-input" type="search" class="search-input" placeholder="{{ trans('web.search_input') }}">
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
                    <div class="accordion" id="accordion-laboratories-prices-list">
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-1">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-1" aria-expanded="false" aria-controls="collapse-accordion-prices-list-1">COVID-19</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-1" class="collapse" aria-labelledby="heading-accordion-prices-list-1" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-2">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-2" aria-expanded="false" aria-controls="collapse-accordion-prices-list-2">Гематологічні дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-2" class="collapse" aria-labelledby="heading-accordion-prices-list-2" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-3">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-3" aria-expanded="false" aria-controls="collapse-accordion-prices-list-3">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-3" class="collapse" aria-labelledby="heading-accordion-prices-list-3" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-4">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-4" aria-expanded="false" aria-controls="collapse-accordion-prices-list-4">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-4" class="collapse" aria-labelledby="heading-accordion-prices-list-4" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-5">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-5" aria-expanded="false" aria-controls="collapse-accordion-prices-list-5">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-5" class="collapse" aria-labelledby="heading-accordion-prices-list-5" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-6">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-6" aria-expanded="false" aria-controls="collapse-accordion-prices-list-6">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-6" class="collapse" aria-labelledby="heading-accordion-prices-list-6" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-7">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-7" aria-expanded="false" aria-controls="collapse-accordion-prices-list-7">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-7" class="collapse" aria-labelledby="heading-accordion-prices-list-7" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-8">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-8" aria-expanded="false" aria-controls="collapse-accordion-prices-list-8">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-8" class="collapse" aria-labelledby="heading-accordion-prices-list-8" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-9">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-9" aria-expanded="false" aria-controls="collapse-accordion-prices-list-9">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-9" class="collapse" aria-labelledby="heading-accordion-prices-list-9" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-accordion-prices-list-10">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-10" aria-expanded="false" aria-controls="collapse-accordion-prices-list-10">Загальноклінічні види дослідження</div>
                                </div>
                            </div>
                            <div id="collapse-accordion-prices-list-10" class="collapse" aria-labelledby="heading-accordion-prices-list-10" data-parent="#accordion-prices-list">
                                <div class="card-body">
                                    <div class="item">
                                        <div class="name">Антитіла IgG до SARS-CoV-2</div>
                                        <div class="price">270 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла IgM до SARS-CoV-2</div>
                                        <div class="price">300 грн</div>
                                    </div>
                                    <div class="item">
                                        <div class="name">Антитіла до S-білку SARS-CoV-2 lgG (кількісне визначення lgG до spike-білку SARS-CoV-2)</div>
                                        <div class="price">400 грн</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
