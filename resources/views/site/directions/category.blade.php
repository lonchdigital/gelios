@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url,
    ])
@endsection

@section('main_class', 'art-direction-template')

@section('content')

    @include('site.directions.partials.breadcrumbs', [
        'breadcrumbs' => $direction->buildBreadcrumbs(),
    ])

    @if(count($direction->children) > 0)
        <section class="category-direction-column-item offices-direction mb-24">
            <div class="container">
                <div class="row mb-8">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div class="h2 font-m font-weight-bolder text-blue">{{ $direction->name ?? '' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="push-menu">
                            <div class="push-menu--nav">
                                <div class="nav-toggle">
                                    <a href="##" class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6">
                                        <span>{{ trans('web.back') }}</span>
                                        <span class="icon"></span>
                                    </a>
                                </div>
                                <div class="push-menu--lvl position-relative">
                                    <div class="item has-dropdown">
                                        <div class="category-directions">
                                            <div class="category-directions--list">
                                                <div class="row">
                                                    @foreach ($direction->children as $child)
                                                        <div class="col-12 col-lg-4 col-xl-3 position-static">
                                                            <div class="directions-item">
                                                                <div class="content item">
                                                                    <a href="{{ url($child->buildFullPath()) }}" class="link">
                                                                        <span>{{ $child->name }}</span>
                                                                        <div class="i-link"></div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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
    @endif

    <section class="media-content">
        <div class="container">
            @include('site.components.text-section', [
                'data' => $direction->textBlocks->where('number', 1)->first(),
                'alt' => $direction->name . ' ' . 1,
                ]
            )
            @include('site.components.text-section', [
                'data' => $direction->textBlocks->where('number', 2)->first(),
                'alt' => $direction->name . ' ' . 2,
                ]
            )
            @include('site.components.text-section', [
                'data' => $direction->textBlocks->where('number', 3)->first(),
                'alt' => $direction->name . ' ' . 3,
                ]
            )
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

    @if (!isEmptyHtml($page->seo_text))
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

@endsection
