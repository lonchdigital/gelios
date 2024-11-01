@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => 'Check up',
                'url' => null,
            ],
        ],
    ])
    <section class="section-check-up mb-24">
        <div class="container">
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
                                                    <span>Акційна ціна
                                                        <span class="new-price">
                                                            <span class="price">{{ $checkUp->new_price }}</span> грн!
                                                        </span>
                                                    </span>
                                                    <span class="old-price font-weight-bold">
                                                        <s>
                                                            {{ $checkUp->price }} грн
                                                        </s>
                                                    </span>
                                                @else
                                                    <span>Ціна
                                                        <span class="new-price">
                                                            <span class="price">{{ $checkUp->price }}</span> грн!
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
                                                <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                    data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                    на
                                                    прийом</a>
                                            </div>
                                            <div class="col-12 col-xxl-6">
                                                <a href="##"
                                                    class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
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
                {{-- <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-2.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-3.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-4.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-5.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-6.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-1.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-7.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-8.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="position-relative h-100">
                        <div class="check-up--item">
                            <div class="inner">
                                <div class="row-gap d-flex flex-column h-100">
                                    <div class="content">
                                        <div class="heading h3 mb-3 font-weight-bolder">Check-up - “Жіноче здоров’я”</div>
                                        <div class="descrp font-weight-bolder">
                                            <span>Акційна ціна
                                                <span class="new-price">
                                                    <span class="price">10 450</span> грн!
                                                </span>
                                            </span>
                                            <span class="old-price font-weight-bold">
                                                <s>
                                                    <span class="price">12 250</span> грн
                                                </s>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content-more">
                                        <div class="content-more--inner">
                                            <div class="row row-gap mb-5">
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
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="content-more--txt">
                                                        <p>До комплексної програми «Жіночій Check-up» включені консультації
                                                            фахівців (вказані вище).</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                        <p>Якщо консультаційні прийоми надаються фахівцем додатково, такі
                                                            прийоми оплачуються окремо, згідно з актуальним прайсом на
                                                            момент звернення. Комплексна програма «Жіночий Check-up»
                                                            передбачає лише два візити: Відвідування №1 – ранній,
                                                            орієнтований час проходження – 3 – 4 години. Відвідування №2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons row mt-auto">
                                        <div class="col-12 col-xxl-6">
                                            <a href="##" class="btn-reception btn btn-block font-weight-bold"
                                                data-toggle="modal" data-target="#popup--sign-up-appointment">Записатись
                                                на прийом</a>
                                        </div>
                                        <div class="col-12 col-xxl-6">
                                            <a href="##"
                                                class="btn btn-read-more--check-up btn-block font-weight-bold">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-img">
                                    <img class="bg-down" src="img/check-up/img-3.jpeg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
@endsection
