@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title . ' ' . __('web.direction_meta_title'),
        'description' => $page->meta_description ?: $page->title . ' ' . __('web.direction_meta_description'),
        'url' => $url,
    ])

    @vite(['resources/js/filters/prices/pricesFilter.js'])
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
                    <div class="accordion" id="accordion-prices-list">
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
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="{{ $page->title ?? 'Геліос' }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const translationsPrices = {
            uah: @json(__('web.uah')),
            free: @json(__('admin.free'))
        };
    </script>

@endsection
