@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $seo[0] ?? $page->meta_title ?: $page->title,
        'description' => $seo[1] ?? $page->meta_description,
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => __('pages.main_page'),
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? __('doctor.doctors'),
                'url' => route('doctors.index'),
            ],
            [
                'title' => $doctor->title ?? '',
                'url' => null,
            ],
        ],
    ])
    <section class="section-doctor mb-24">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                    <div class="wrap-img">
                        <img class="bg-down" src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="doctor-descrp">
                        <div class="row mb-1">
                            <div class="col-8">
                                <div class="h3 font-m font-weight-bolder text-blue">{{ $doctor->title ?? '' }}</div>
                            </div>
                        </div>
                        <div class="position-work font-weight-bold text-grey mb-3">Лікар
                            {{ $doctor->specialization->title ?? '' }}</div>

                        @if(!empty($doctor->expirience))
                            <div class="experience-quantity mb-3">Досвід роботи: {{ $doctor->expirience ?? '' }} років</div>
                        @endif

                        <div class="os-scrollbar-overflow content mb-3">
                            <div class="mb-3">
                                <span
                                    class="text-blue mr-3">Спеціальність:</span><span>{{ $doctor->specialty ?? '' }}</span>
                            </div>
                            <div class="mb-3">
                                <span
                                    class="text-blue mr-3">Спеціалізація:</span><span>{{ $doctor->specialization->title ?? '' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="text-blue mr-3">Стаж:</span><span>{{ $doctor->age ?? '' }} роки</span>
                            </div>
                            <div class="mb-3">
                                <span class="text-blue mr-3">Освіта:</span><span>{{ $doctor->education }}</span>
                            </div>
                            {!! $doctor->content !!}
                            {{-- <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>2006-2011 Зав. терапевтичного відділення МКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2012 Зав. приймального відділення КЗДМКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p>
                            <p>2006-2011 Зав. терапевтичного відділення МКЛ №11 в м. Дніпропетровськ</p>
                            <p>2011-2012 Зав. приймального відділення КЗДМКЛ №11 в м. Дніпропетровськ</p>
                            <p>2012-2019 Зав. терапевтичного відділення КЗДМКЛ №11 м. Дніпро</p>
                            <p>2011-2021 Працювала лікарем приймального відділення</p>
                            <p>1993-1999 Дніпропетровська державна медична академія</p> --}}
                        </div>
                        <div class="text-blue font-weight-bold mb-2">Напрямки лікування:</div>
                        <div class="doctor-directions-list font-weight-bold mb-4">
                            <div class="item">Хірургія</div>
                            <div class="item">Загальна хірургія</div>
                            <div class="item">Офтальмологія</div>
                            <div class="item">Хірургія ока</div>
                            <div class="item">Мікрохірургія</div>
                        </div>
                        <button type="button" class="btn btn-blue font-weight-bold">Записатися на прийом</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="certificates mb-24">
        <div class="container overflow-hidden">
            <div class="row mb-8">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">Дипломи та сертифікати</div>
                </div>
            </div>
            <div class="certificates--swiper">
                <div class="swiper-wrapper mb-8">
                    @forelse($doctor->imagesUrl as $image)
                        <div class="certificates--item swiper-slide">
                            <a data-fancybox="certificates--gallery" href="{{ $image }}">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="{{ $image }}" alt="{{ $doctor->title ?? '' }}">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                    {{-- <div class="certificates--item swiper-slide">
                        <a data-fancybox="certificates--gallery" href="img/certificate.jpeg">
                            <div class="inner">
                                <div class="wrap-img">
                                    <img src="img/certificate.jpeg" alt="img">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="certificates--item swiper-slide">
                        <a data-fancybox="certificates--gallery" href="img/certificate.jpeg">
                            <div class="inner">
                                <div class="wrap-img">
                                    <img src="img/certificate.jpeg" alt="img">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="certificates--item swiper-slide">
                        <a data-fancybox="certificates--gallery" href="img/certificate.jpeg">
                            <div class="inner">
                                <div class="wrap-img">
                                    <img src="img/certificate.jpeg" alt="img">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="certificates--item swiper-slide">
                        <a data-fancybox="certificates--gallery" href="img/certificate.jpeg">
                            <div class="inner">
                                <div class="wrap-img">
                                    <img src="img/certificate.jpeg" alt="img">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="certificates--item swiper-slide">
                        <a data-fancybox="certificates--gallery" href="img/certificate.jpeg">
                            <div class="inner">
                                <div class="wrap-img">
                                    <img src="img/certificate.jpeg" alt="img">
                                </div>
                            </div>
                        </a>
                    </div> --}}
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <section class="reviews mb-24">
        <div class="container overflow-hidden">
            <div class="row mb-19">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">Відгуки</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="reviews--swiper">
                        <div class="swiper-wrapper">
                            <div class="reviews--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="img/users/user-1.jpeg" alt="img">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="user-name h4 font-weight-bolder">Вікторія</div>
                                        <div class="reviews-date h6 font-weight-bold text-grey">10.07.2024</div>
                                    </div>
                                    <div class="reviews--content os-scrollbar-overflow">Все дуже професійно в цьому
                                        медичному центрі для реабілітації після травми. Обладнання новітнє, відмінні
                                        фахівці. Сервіс на високому рівні. Зручне місце розташування, є своя парковка з
                                        відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!Все дуже
                                        професійно в цьому медичному центрі для реабілітації після травми. Обладнання
                                        новітнє, відмінні фахівці. Сервіс на високому рівні. Зручне місце розташування, є
                                        своя парковка з відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!
                                    </div>
                                </div>
                            </div>
                            <div class="reviews--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="img/users/user-2.jpeg" alt="img">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="user-name h4 font-weight-bolder">Вікторія</div>
                                        <div class="reviews-date h6 font-weight-bold text-grey">10.07.2024</div>
                                    </div>
                                    <div class="reviews--content os-scrollbar-overflow">Все дуже професійно в цьому
                                        медичному центрі для реабілітації після травми. Обладнання новітнє, відмінні
                                        фахівці. Сервіс на високому рівні. Зручне місце розташування, є своя парковка з
                                        відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!Все дуже
                                        професійно в цьому медичному центрі для реабілітації після травми. Обладнання
                                        новітнє, відмінні фахівці. Сервіс на високому рівні. Зручне місце розташування, є
                                        своя парковка з відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!
                                    </div>
                                </div>
                            </div>
                            <div class="reviews--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="img/users/user-1.jpeg" alt="img">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="user-name h4 font-weight-bolder">Вікторія</div>
                                        <div class="reviews-date h6 font-weight-bold text-grey">10.07.2024</div>
                                    </div>
                                    <div class="reviews--content os-scrollbar-overflow">Все дуже професійно в цьому
                                        медичному центрі для реабілітації після травми. Обладнання новітнє, відмінні
                                        фахівці. Сервіс на високому рівні. Зручне місце розташування, є своя парковка з
                                        відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!Все дуже
                                        професійно в цьому медичному центрі для реабілітації після травми. Обладнання
                                        новітнє, відмінні фахівці. Сервіс на високому рівні. Зручне місце розташування, є
                                        своя парковка з відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!
                                    </div>
                                </div>
                            </div>
                            <div class="reviews--item swiper-slide">
                                <div class="inner">
                                    <div class="wrap-img">
                                        <img src="img/users/user-2.jpeg" alt="img">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="user-name h4 font-weight-bolder">Вікторія</div>
                                        <div class="reviews-date h6 font-weight-bold text-grey">10.07.2024</div>
                                    </div>
                                    <div class="reviews--content os-scrollbar-overflow">Все дуже професійно в цьому
                                        медичному центрі для реабілітації після травми. Обладнання новітнє, відмінні
                                        фахівці. Сервіс на високому рівні. Зручне місце розташування, є своя парковка з
                                        відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!Все дуже
                                        професійно в цьому медичному центрі для реабілітації після травми. Обладнання
                                        новітнє, відмінні фахівці. Сервіс на високому рівні. Зручне місце розташування, є
                                        своя парковка з відеоспостереженням. Смачна кава і привітний персонал. Рекомендую!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination mt-8"></div>
                    </div>
                </div>
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
                                <button type="button"
                                    class="btn btn-blue font-weight-bold w-100 mt-2">Записатися</button>
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
    <section class="news news-doctor mb-24">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col d-flex align-items-center justify-content-between mb-5">
                    <div class="h2 font-m font-weight-bolder text-blue">Новини</div>
                    <a href="##" class="btn btn-white font-weight-bold">Усі новини</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="news--swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-1.jpeg" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує..</div>
                                </a>
                            </div>
                            <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-2.jpeg" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує..</div>
                                </a>
                            </div>
                            <div class="swiper-slide news--item">
                                <a href="##" class="inner">
                                    <div class="wrap-img mb-4">
                                        <img src="img/articles/article-3.jpeg" alt="img">
                                        <div class="date-label">13 березня 2024</div>
                                    </div>
                                    <div class="h3 small mb-2">Консультація анестезіолога у Дніпрі</div>
                                    <div class="descrp">Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує Медичний центр сімейного здоров’я та реабілітації “Геліос” у Дніпрі
                                        пропонує..</div>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-pagination mt-6 d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
