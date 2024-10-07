@extends('site.layout.app')

@section('content')

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => '111111111111',
                'url' => route('doctors.index'),
            ],
            [
                'title' => $direction->name ?? '',
                'url' => null,
            ],
        ],
    ])
    
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
                                <a href="##"
                                    class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>Назад</span><span
                                        class="icon"></span></a>
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
                                                                <a href="##" class="link">
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

    <section class="media-content">
        <div class="container">
            
            @include('site.components.text-section', ['data' => $direction->textBlocks->where('number', 1)->first()])
            
            <div class="media-content--inner row flex-column-reverse flex-lg-row-reverse mb-24">
                <div class="col-12 col-lg-6">
                    <div class="content-wrap">
                        <div class="h3 font-weight-bolder text-blue mb-5">Ознаки необхідності консультації терапевта:
                        </div>
                        <div class="content os-scrollbar-overflow">
                            <ul class="list-unstyled mb-0">
                                <li>підвищена температура, ГРВІ</li>
                                <li>будь-якого характеру і тривалості болю в різних частинах тіла</li>
                                <li>регулярне відчуття втоми</li>
                                <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                                <li>підвищений або знижений артеріальний тиск</li>
                                <li>паморочиться або болить голова</li>
                                <li>погіршення пам’яті</li>
                                <li>висипи на шкірі</li>
                                <li>проблеми з травленням</li>
                                <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                                <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                                <li>підвищений або знижений артеріальний тиск</li>
                                <li>паморочиться або болить голова</li>
                                <li>погіршення пам’яті</li>
                                <li>висипи на шкірі</li>
                                <li>проблеми з травленням</li>
                                <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="wrap-img">
                        <img src="img/media/image-266.jpeg" alt="img">
                    </div>
                </div>
            </div>
            <div class="media-content--inner row flex-column-reverse flex-lg-row mb-24">
                <div class="col-12 col-lg-6">
                    <div class="content-wrap">
                        <div class="h3 font-weight-bolder text-blue mb-5">Чому варто вибрати “Геліос”?</div>
                        <div class="content os-scrollbar-overflow">
                            <ul class="list-unstyled mb-0">
                                <li>підвищена температура, ГРВІ</li>
                                <li>будь-якого характеру і тривалості болю в різних частинах тіла</li>
                                <li>регулярне відчуття втоми</li>
                                <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                                <li>підвищений або знижений артеріальний тиск</li>
                                <li>паморочиться або болить голова</li>
                                <li>погіршення пам’яті</li>
                                <li>висипи на шкірі</li>
                                <li>проблеми з травленням</li>
                                <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                                <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                                <li>підвищений або знижений артеріальний тиск</li>
                                <li>паморочиться або болить голова</li>
                                <li>погіршення пам’яті</li>
                                <li>висипи на шкірі</li>
                                <li>проблеми з травленням</li>
                                <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="wrap-img">
                        <img src="img/media/image-267.jpeg" alt="img">
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
    <section class="seo mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 font-weight-bolder text-blue mb-8">SEO</div>
                    <div class="seo-wrapper">
                        <div class="content os-scrollbar-overflow">
                            <p>Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне обладнання,
                                кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша клініка керується
                                міжнародними медичними стандартами і використовує всі інноваційні методи діагностики і
                                терапії. Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне
                                обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша
                                клініка керується міжнародними медичними стандартами і використовує всі інноваційні
                                методи діагностики і терапії.</p>
                            <p>Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне обладнання,
                                кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша клініка керується
                                міжнародними медичними стандартами і використовує всі інноваційні методи діагностики і
                                терапії. Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне
                                обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша
                                клініка керується міжнародними медичними стандартами і використовує всі інноваційні
                                методи діагностики і терапії. </p>
                            <p>Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне обладнання,
                                кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша клініка керується
                                міжнародними медичними стандартами і використовує всі інноваційні методи діагностики і
                                терапії. Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне
                                обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша
                                клініка керується міжнародними медичними стандартами і використовує всі інноваційні
                                методи діагностики і терапії.</p>
                            <p>Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне обладнання,
                                кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша клініка керується
                                міжнародними медичними стандартами і використовує всі інноваційні методи діагностики і
                                терапії. Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне
                                обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта. Наша
                                клініка керується міжнародними медичними стандартами і використовує всі інноваційні
                                методи діагностики і терапії. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
