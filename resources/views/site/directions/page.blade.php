@extends('site.layout.app')

@section('content')

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => trans('web.directions'),
            ],
        ],
    ])
    
    @include('site.directions.partials.our-directions-section')

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

@endsection