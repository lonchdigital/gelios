@extends('site.layout.app')

@section('content')
@include('site.components.breadcrumbs', [
    'breadcrumbs' => [
        [
            'title' => 'Головна',
            'url' => route('main'),
        ],
        [
            'title' => 'Блог',
            'url' => route('articles.index'),
        ],
        [
            'title' => $article->title ?? '',
            'url' => null,
        ],
    ],
])
    <section class="section-top mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6 mb-8 mb-xl-0">
                    <div class="section-top--backdrop-swiper overflow-hidden h-100 position-relative">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-16">
                                        <div class="h1 font-m font-weight-bolder mb-3">{{ $article->title }}
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">{!! $article->description !!}</div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ $article->imageUrl }}" alt="{{ $article->title }}">
                                    <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}  {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }} {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                                </div>
                            </div>
                            @forelse($article->imagesUrl ?? [] as $image)
                                <div
                                    class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                    <div class="backdrop p-3 p-lg-6">
                                        <div class="content mt-16">
                                            <div class="h1 font-m font-weight-bolder mb-3">{{ $article->title }}
                                            </div>
                                            <div class="h5 font-m font-weight-bold mb-3">{!! $article->description !!}</div>
                                        </div>
                                    </div>
                                    <div class="wrap-img">
                                        <img class="bg-down" src="{{ $image }}" alt="{{ $article->title }}">
                                        <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}  {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }} {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            {{-- <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-16">
                                        <div class="h1 font-m font-weight-bolder mb-3">Консультація <br>анестезіолога
                                            <br>у Дніпрі
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="{{ asset('img/img-background-1.jpeg') }}" alt="img">
                                    <div class="date-label">13 березня 2024</div>
                                </div>
                            </div>
                            <div
                                class="swiper-slide position-relative align-content-end h-100 rounded-sm overflow-hidden text-white">
                                <div class="backdrop p-3 p-lg-6">
                                    <div class="content mt-16">
                                        <div class="h1 font-m font-weight-bolder mb-3">Консультація <br>анестезіолога
                                            <br>у Дніпрі
                                        </div>
                                        <div class="h5 font-m font-weight-bold mb-3">Обери свій CHECK-UP!</div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/img-background-2.jpeg" alt="img">
                                    <div class="date-label">13 березня 2024</div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
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
                                <button type="button"
                                    class="btn btn-blue font-weight-bold w-100 mt-2">Записатися</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="articles mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="articles--list">
                        @forelse($article->articleBlocks()->orderBy('sort', 'ASC')->get() as $block)

                        @if($block->type == 'one_block')
                            <div class="articles--item">
                                {{-- <p>Медичний центр сімейного здоров'я та реабілітації “Геліос” у Дніпрі пропонує прийом
                                    лікаря-анестезіолога пацієнтам, які готуються до планового хірургічного втручання.</p>
                                <p>Оперативне лікування неможливе без анестезіолога-реаніматолога. Його завдання —
                                    забезпечувати проведення хірургічної операції у тісній взаємодії з хірургом. Але якщо в
                                    компетенції хірурга – показання до оперативного втручання, то завдання анестезіолога –
                                    виявити протипоказання, тобто. здійснити доступ пацієнта до операції. Медичний центр
                                    сімейного здоров'я та реабілітації “Геліос” у Дніпрі пропонує прийом
                                    лікаря-анестезіолога пацієнтам, які готуються до планового хірургічного втручання.</p>
                                <p>Оперативне лікування неможливе без анестезіолога-реаніматолога.</p> --}}
                                <div class="title">{{ $block->first_title }}</div>
                                <p>
                                    {{ $block->first_content }}
                                </p>
                            </div>
                        @else
                            <div class="columns">
                                <div class="articles--item">
                                    <div class="title">{{ $block->first_title }}</div>
                                    <p>{{ $block->first_content }}</p>
                                </div>
                                <div class="articles--item">
                                    <div class="title">{{ $block->second_title }}</div>
                                    <p>{{ $block->second_content }}</p>
                                </div>
                            </div>
                        @endif

                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-9 col-md-7 col-lg-5">
                    <div class="articles-author">
                        <div class="wrap-img">
                            <img src="img/users/user-1.jpeg" alt="img">
                        </div>
                        <div class="articles-author--descrp mt-xxl-1">
                            <div class="name h4 font-weight-bolder text-blue mb-1">Анна Григораш</div>
                            <div class="position-work h5 font-weight-bold text-blue mb-1 mb-xxl-0">Педіатор</div>
                            <div class="place-work font-weight-bold text-grey">Медичний центр сімецного здоров’я та
                                реабілітації “Геліос” у Дніпрі</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="news mb-24">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col d-flex align-items-center justify-content-between mb-5">
                    <div class="h3 font-m font-weight-bolder text-blue">Дивіться також</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="news--swiper">
                        <div class="swiper-wrapper">
                            @forelse($relatedArticles as $relatedArticle)
                                <div class="swiper-slide news--item">
                                    <a href="{{ route('articles.show', ['slug' => $relatedArticle->slug]) }}" class="inner">
                                        <div class="wrap-img mb-4">
                                            <img src="{{ $relatedArticle->imageUrl }}" alt="{{ $relatedArticle->title }}">
                                            <div class="date-label">{{ Carbon\Carbon::parse($relatedArticle->created_at)->day }}  {{ Carbon\Carbon::parse($relatedArticle->created_at)->translatedFormat('F') }} {{ Carbon\Carbon::parse($relatedArticle->created_at)->year }}</div>
                                        </div>
                                        <div class="h3 small mb-2">{{ $relatedArticle->title }}</div>
                                        <div class="descrp">{!! $relatedArticle->description !!}</div>
                                    </a>
                                </div>
                            @empty
                            @endforelse
                            {{-- <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-2.jpeg" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div>
                            <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-3.jpeg" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у
                                        Дніпрі пропонує..</div>
                                </a>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination mt-6 d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
