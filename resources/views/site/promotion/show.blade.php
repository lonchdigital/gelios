@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => 'Акції',
                'url' => route('promotions.index'),
            ],
            [
                'title' => $promotion->title ?? '',
                'url' => null,
            ],
        ],
    ])
    <section class="section-top section-top-3 mb-24">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-12 col-lg-6">
                    <div class="media-content">
                        <div class="media-content--inner row flex-column-reverse flex-lg-row">
                            <div class="col-12">
                                <div class="content-wrap d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="h3 font-m font-weight-bolder text-blue mb-5">{{ $promotion->title }}
                                        </div>
                                        <div class="content os-scrollbar-overflow">
                                            <p>{{ $promotion->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($promotion->image)
                    <div class="col-12 col-lg-6 mb-8 mb-lg-0">
                        <div
                            class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                            <div class="backdrop position-static">
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ $promotion->imageUrl }}"
                                        alt="{{ $promotion->title ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="meeting mb-24 py-lg-16">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-7 col-lg-6">
                    <form id="form-meeting" class="p-3 p-lg-5 bg-white">
                        <div class="h2 font-m font-weight-bolder mb-5">Записатися на прийом</div>
                        <div class="row field-wrap">
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-meeting-name">Вкажіть ПІБ</label>
                                    <input type="text" id="form-meeting-name" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-meeting-phone">Вкажіть номер
                                        телефону</label>
                                    <input type="tel" id="form-meeting-phone" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">Вкажіть номер телефону</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <div class="control-label mb-2">Оберіть фахівця</div>
                                    <div class="select-wrap">
                                        <select class="select-choose-specialist">
                                            <option></option>
                                            <option value="1">Фахівeць 1</option>
                                            <option value="2">Фахівeць 2</option>
                                            <option value="3">Фахівeць 3</option>
                                            <option value="4">Фахівeць 4</option>
                                        </select>
                                    </div>
                                    <div class="field--help-info small-txt text-red mb-2">Оберіть фахівця</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <div class="control-label mb-2">Оберіть клініку</div>
                                    <div class="select-wrap">
                                        <select class="select-choose-clinic">
                                            <option></option>
                                            <option value="1">Клініка 1</option>
                                            <option value="2">Клініка 2</option>
                                            <option value="3">Клініка 3</option>
                                            <option value="4">Клініка 4</option>
                                        </select>
                                    </div>
                                    <div class="field--help-info small-txt text-red mb-2">Оберіть клініку</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-blue font-weight-bold w-100 mt-2">Записатися</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-5 col-lg-6 d-none d-lg-flex">
                    <div class="wrap-img">
                        <img src="img/img-right-b.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shares news mb-24">
        <div class="container overflow-hidden">
            <div class="row mb-8">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">Більше акцій</div>
                    <a href="{{ route('promotions.index') }}" class="btn btn-white font-weight-bold">Усі акції</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="news--swiper">
                        <div class="swiper-wrapper">
                            @forelse($promotions as $promotion2)
                                <div class="swiper-slide news--item">
                                    <a href="{{ route('promotions.show', ['promotion' => $promotion2->slug]) }}"
                                        class="inner">
                                        <div class="wrap-img mb-4">
                                            @if ($promotion2->image)
                                                <img src="{{ $promotion2->imageUrl }}" alt="{{ $promotion2->title ?? '' }}">
                                            @endif
                                        </div>
                                        <div class="h3 small mb-2">{{ $promotion2->title ?? '' }}</div>
                                    </a>
                                </div>
                            @empty
                            @endforelse
                            {{-- <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-2.jpeg" alt="img">
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                </a>
                            </div>
                            <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-3.jpeg" alt="img">
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                </a>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination mt-6 d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="shares-list row">
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-1.jpeg" alt="img">
                                </div>
                                <div class="h3">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-2.jpeg" alt="img">
                                </div>
                                <div class="h3">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                        <div class="shares--item content-item col-12 col-md-6 col-xl-4">
                            <a href="##" class="inner">
                                <div class="wrap-img mb-4">
                                    <img src="img/shares/card-img-3.jpeg" alt="img">
                                </div>
                                <div class="h3">Консультація анестезіолога у Дніпрі</div>
                            </a>
                        </div>
                    </div> -->
        </div>
    </section>
@endsection
