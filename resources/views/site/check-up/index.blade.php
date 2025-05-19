@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Check up',
                'url' => null,
            ],
        ],
    ])
    <section class="section-check-up mb-24">
        <div class="container">
		  		<div class="row mb-8">
               <div class="col d-flex align-items-center justify-content-between">
                  	<h1 class="h2 font-m font-weight-bolder text-blue">{{ $page->title ?? __('pages.promotions') }}</h1>
                  </div>
               </div>
            <div class="check-up--list row row-gap">
                @forelse($checkUps as $checkUp)
                    <div class="col-12 col-lg-6">
                        <div class="position-relative h-100">
                            <div class="check-up--item">
                                <div class="inner">
                                    <div class="row-gap d-flex flex-column h-100">
                                        <div class="content">
                                            <div class="heading h3 mb-3 font-weight-bolder">{{ $checkUp->title }}</div>
                                            <div class="descrp font-weight-bolder">
                                                @if ($checkUp->new_price)
                                                    <span>
                                                        {{ __('web.promotional_price') }}
                                                        <span class="new-price">
                                                            <span class="price">{{ $checkUp->new_price }}</span>
                                                        </span>
                                                    </span>
                                                    <span class="old-price font-weight-bold">
                                                        <s>
                                                            {{ $checkUp->price }}
                                                        </s>
                                                    </span>
                                                @else
                                                    <span>
                                                        {{ __('web.price') }}
                                                        <span class="new-price">
                                                            <span class="price">{{ $checkUp->price }}</span>
                                                        </span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="content-more">
                                            <div class="content-more--inner">
                                                <div class="row row-gap mb-5">
                                                    @forelse($checkUp->checkUpPrograms as $program)
                                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                            <div class="item">
                                                                <div class="heading title h4 mb-3">{{ $program->title }}:
                                                                </div>
                                                                <div class="spoiler-list">
                                                                    <ul class="list-unstyled mb-0">
                                                                        @forelse($program->options ?? [] as $option)
                                                                            <li>{{ $option }}</li>
                                                                        @empty
                                                                        @endforelse
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                    {{-- <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                        <div class="item">
                                                            <div class="heading title h4 mb-3">Ультразвукова діагностика:</div>
                                                            <div class="spoiler-list">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>УЗД ОЧП + нирок</li>
                                                                    <li>УЗД щитоподітбої залози</li>
                                                                    <li>УЗД серця (ехо кардіографія)</li>
                                                                    <li>ЕКГ</li>
                                                                    <li>Консультація Терапевта</li>
                                                                    <li>Консультація Гінеколога</li>
                                                                    <li>Консультація Маммолога</li>
                                                                    <li>Консультація Ендокринолога</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                        <div class="item">
                                                            <div class="heading title h4 mb-3">Лабораторні дослідження:</div>
                                                            <div class="spoiler-list">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>Загальний аналіз сечі</li>
                                                                    <li>Загальний аналіз крові</li>
                                                                    <li>Печінково нирковий комплекс</li>
                                                                    <li>Тиреотропний гормон (ТТГ)</li>
                                                                    <li>Консультація Терапевта</li>
                                                                    <li>Консультація Гінеколога</li>
                                                                    <li>Консультація Маммолога</li>
                                                                    <li>Консультація Ендокринолога</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                        <div class="item">
                                                            <div class="heading title h4 mb-3">Програма містить*:</div>
                                                            <div class="spoiler-list">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>Консультація Терапевта</li>
                                                                    <li>Консультація Гінеколога</li>
                                                                    <li>Консультація Маммолога</li>
                                                                    <li>Консультація Ендокринолога</li>
                                                                    <li>Консультація Терапевта</li>
                                                                    <li>Консультація Гінеколога</li>
                                                                    <li>Консультація Маммолога</li>
                                                                    <li>Консультація Ендокринолога</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="content-more--txt os-scrollbar-overflow">
                                                            <p>{!! $checkUp->description !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons row mt-auto">
                                            <div class="col-12 col-xxl-6">
                                                <a class="btn-reception btn btn-block font-weight-bold"
                                                    data-toggle="modal" data-target="#popup--sign-up-appointment">{{ __('pages.sign_up_for_for_appointment') ?? 'Записатись на прийом' }}</a>
                                            </div>
                                            <div class="col-12 col-xxl-6">
                                                <a
                                                    class="btn btn-read-more--check-up btn-block font-weight-bold">{{ __('pages.read_more') ?? 'Детальніше' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        @if ($checkUp->image)
                                            <img class="bg-down" src="{{ $checkUp->imageUrl }}"
                                                alt="{{ $checkUp->title ?? '' }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
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
                        <img src="{{ asset('static_images/img-right-b.png') }}" alt="Check up">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
