@extends('site.layout.app')

@section('content')
    <section class="nav-breadcrumb mt-8 mb-8">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <svg class="i-home">
                                        <use xlink:href="{{ asset('styles/img/icons/icons.svg#i-home') }}"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Блог</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="news-head mb-8">
        <div class="container">
            <div class="row align-items-center justify-content-between w-100 mb-5">
                <div class="col-auto">
                    <div class="h2 font-m font-weight-bolder text-blue">Блог</div>
                </div>
                <div class="col-auto">
                    <div class="field field-select-default">
                        <div class="select-wrap">
                            <select class="select-news-category">
                                <option></option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @empty
                                @endforelse

                                {{-- <option value="1">Гінеколог</option>
                                <option value="2">Стоматолог</option>
                                <option value="3">Хірург</option>
                                <option value="4">Отоларинголог</option>
                                <option value="5">Алерголог</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-top mb-8 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 col-xxl-8 mb-4 mb-lg-0">
                    <div class="section-top--backdrop-swiper overflow-hidden h-100 position-relative">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-background-1.jpeg') }}" alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-background-2.jpeg') }}" alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-background-1.jpeg') }}" alt="img">
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content">
                                        <div class="h1 font-m font-weight-bolder mb-3">Піклуєшся <br> про здоров’я?
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                        <a href="##" class="btn btn-white font-weight-bold">Детальніше</a>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-background-2.jpeg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xxl-4">
                    <div class="row flex-row flex-lg-column">
                        <div class="col-12 col-md-6 col-lg-12 mb-4 mb-md-0 mb-lg-5">
                            <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                <div class="backdrop-small align-content-end d-flex align-items-end p-3 p-lg-6 ">
                                    <div class="h4 font-weight-bolder mb-2">Підпиши <br>декларацію <br>за 5 хвилин</div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-79.jpeg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="position-relative rounded-sm overflow-hidden text-white h-100">
                                <div class="backdrop-small text-right p-3 p-lg-6">
                                    <div class="h4 font-weight-bolder">Підпиши <br>декларацію <br>за 5 хвилин</div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('styles/img/img-77.jpeg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="news" class="news mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="news-list row">
                        @forelse($articles as $article)
                            <div class="content-item col-12 col-md-6 col-xl-4">
                                <div class="news--item">
                                    <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="inner">
                                        <div class="wrap-img mb-4">
                                            @if($article->image)
                                                <img src="{{ $article->imageUrl }}" alt="{{ $article->title }}">
                                            @else
                                                <img src="{{ asset('styles/img/articles/article-1.jpeg') }}" alt="img">
                                            @endif
                                            <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}  {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }} {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                                        </div>
                                        <div class="h3 small mb-2">{{ $article->title }}</div>
                                        <div class="h6 descrp">{{ $article->description }}</div>
                                    </a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{-- <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-2.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-3.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="content-item col-12 col-md-6 col-xl-4">
                            <div class="news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="{{ asset('styles/img/articles/article-1.jpeg') }}" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="h6 descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="mt-5 mt-lg-3">
                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection