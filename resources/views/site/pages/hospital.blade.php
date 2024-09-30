@extends('site.layout.app')

@section('content')
    <main class="main">
        <section class="nav-breadcrumb mt-8 mb-8">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <svg class="i-home">
                                            <use xlink:href="img/icons/icons.svg#i-home"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Стаціонар</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-top-2 mb-24">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-8 mb-xl-0">
                        <div
                            class="d-flex flex-column justify-content-end position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                            <div class="backdrop">
                                <div class="content">
                                    <div class="h1 font-m font-weight-bolder mb-3">Стаціонар</div>
                                    <div class="h5 font-weight-bold">Безкоштовна консультація</div>
                                </div>
                            </div>
                            <div class="wrap-img">
                                <img class="bg-down" src="{{ asset('styles/img/img-background-1.jpeg') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        @include('site.components.appointment-form')
                    </div>
                </div>
            </div>
        </section>
        <section class="section-progress text-white mb-24">
            <div class="container">
                <div class="row flex-column flex-lg-row">
                    <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                        <div class="section-progress--item position-relative h-100 rounded overflow-hidden">
                            <div class="wrap-img">
                                <img class="bg-down" src="img/img-251.jpeg" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                                <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                    <div class="quantity h2 font-m font-weight-bolder mb-2">2&nbsp;640</div>
                                    <div class="h5 text-uppercase">Проведено операцій</div>
                                </div>
                            </div>
                            <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                                <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                    <div class="quantity h2 font-m font-weight-bolder mb-2">14</div>
                                    <div class="h5 text-uppercase">Років досвіду</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                    <div class="quantity h2 font-m font-weight-bolder mb-2">24/7</div>
                                    <div class="h5 text-uppercase">Ми поряд</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                                    <div class="quantity h2 font-m font-weight-bolder mb-2">100 000</div>
                                    <div class="h5 text-uppercase">Відвідувань щороку</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($pageTextBlock)
            <section class="media-content">
                <div class="container">
                    <div class="media-content--inner row {{ ($pageTextBlock->is_reverse) ? 'flex-column-reverse flex-lg-row-reverse' : '' }} mb-24">
                        <div class="col-12 col-lg-6">
                            <div class="content-wrap">
                                <div class="h4 font-weight-bolder text-blue mb-5">У Центрі Геліос застосовуються найсучасніші
                                    методики фізіотерапії, які дозволяють досягти максимальної ефективності лікування
                                    щонайшвидше і забезпечити належний рівень якості життя пацієнтів.</div>
                                <div class="content os-scrollbar-overflow">
                                    <p>При цілодобовому перебуванні проводиться спостереження висококваліфікованим медичним
                                        персоналом, виконуються медичні маніпуляції, спрямовані на швидке одужання пацієнта.
                                        Спостереження в стаціонарі клініки здійснюють компетентні лікарі і медичні сестри, які
                                        роблять маніпуляції безболісно і професійно, а також досконало володіють навичками
                                        надання оперативної допомоги кожному пацієнту. Персонал регулярно працює над підвищенням
                                        кваліфікації. Команда Центру Геліос докладає всіх зусиль, щоб пацієнти, які перебувають
                                        в нашому стаціонарі швидше отримували необхідні маніпуляції з дотриманням строгих
                                        заходів безпеки і комфорту.</p>
                                    <p>При цілодобовому перебуванні проводиться спостереження висококваліфікованим медичним
                                        персоналом, виконуються медичні маніпуляції, спрямовані на швидке одужання пацієнта.
                                        Спостереження в стаціонарі клініки здійснюють компетентні лікарі і медичні сестри, які
                                        роблять маніпуляції безболісно і професійно, а також досконало володіють навичками
                                        надання оперативної допомоги кожному пацієнту. Персонал регулярно працює над підвищенням
                                        кваліфікації. Команда Центру Геліос докладає всіх зусиль, щоб пацієнти, які перебувають
                                        в нашому стаціонарі швидше отримували необхідні маніпуляції з дотриманням строгих
                                        заходів безпеки і комфорту.</p>
                                    <p>При цілодобовому перебуванні проводиться спостереження висококваліфікованим медичним
                                        персоналом, виконуються медичні маніпуляції, спрямовані на швидке одужання пацієнта.
                                        Спостереження в стаціонарі клініки здійснюють компетентні лікарі і медичні сестри, які
                                        роблять маніпуляції безболісно і професійно, а також досконало володіють навичками
                                        надання оперативної допомоги кожному пацієнту. Персонал регулярно працює над підвищенням
                                        кваліфікації. Команда Центру Геліос докладає всіх зусиль, щоб пацієнти, які перебувають
                                        в нашому стаціонарі швидше отримували необхідні маніпуляції з дотриманням строгих
                                        заходів безпеки і комфорту.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="wrap-img">
                                <img src="{{ '/storage/' . $pageTextBlock->image }}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="hospitals-list mb-24">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="accordion" id="accordion-hospitals-list">
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-hospitals-list-1">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-hospitals-list-1" aria-expanded="false"
                                            aria-controls="collapse-accordion-hospitals-list-1">Стаціонар 1
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-hospitals-list-1" class="collapse"
                                    aria-labelledby="heading-accordion-hospitals-list-1"
                                    data-parent="#accordion-hospitals-list">
                                    <div class="card-body media-content">
                                        <div class="row flex-column-reverse flex-lg-row">
                                            <div class="col-12">
                                                <div class="media-content--inner row flex-column-reverse flex-lg-row">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="content-wrap">
                                                            <div class="h4 font-weight-bolder text-blue mb-5">У Центрі
                                                                Геліос застосовуються найсучасніші методики фізіотерапії,
                                                                які дозволяють досягти максимальної ефективності лікування
                                                                щонайшвидше і забезпечити належний рівень якості життя
                                                                пацієнтів.</div>
                                                            <div class="content os-scrollbar-overflow">
                                                                <p>При цілодобовому перебуванні проводиться спостереження
                                                                    висококваліфікованим медичним персоналом, виконуються
                                                                    медичні маніпуляції, спрямовані на швидке одужання
                                                                    пацієнта. Спостереження в стаціонарі клініки здійснюють
                                                                    компетентні лікарі і медичні сестри, які роблять
                                                                    маніпуляції безболісно і професійно, а також досконало
                                                                    володіють навичками надання оперативної допомоги кожному
                                                                    пацієнту. Персонал регулярно працює над підвищенням
                                                                    кваліфікації. Команда Центру Геліос докладає всіх
                                                                    зусиль, щоб пацієнти, які перебувають в нашому
                                                                    стаціонарі швидше отримували необхідні маніпуляції з
                                                                    дотриманням строгих заходів безпеки і комфорту.</p>
                                                                <p>При цілодобовому перебуванні проводиться спостереження
                                                                    висококваліфікованим медичним персоналом, виконуються
                                                                    медичні маніпуляції, спрямовані на швидке одужання
                                                                    пацієнта. Спостереження в стаціонарі клініки здійснюють
                                                                    компетентні лікарі і медичні сестри, які роблять
                                                                    маніпуляції безболісно і професійно, а також досконало
                                                                    володіють навичками надання оперативної допомоги кожному
                                                                    пацієнту. Персонал регулярно працює над підвищенням
                                                                    кваліфікації. Команда Центру Геліос докладає всіх
                                                                    зусиль, щоб пацієнти, які перебувають в нашому
                                                                    стаціонарі швидше отримували необхідні маніпуляції з
                                                                    дотриманням строгих заходів безпеки і комфорту.</p>
                                                                <p>При цілодобовому перебуванні проводиться спостереження
                                                                    висококваліфікованим медичним персоналом, виконуються
                                                                    медичні маніпуляції, спрямовані на швидке одужання
                                                                    пацієнта. Спостереження в стаціонарі клініки здійснюють
                                                                    компетентні лікарі і медичні сестри, які роблять
                                                                    маніпуляції безболісно і професійно, а також досконало
                                                                    володіють навичками надання оперативної допомоги кожному
                                                                    пацієнту. Персонал регулярно працює над підвищенням
                                                                    кваліфікації. Команда Центру Геліос докладає всіх
                                                                    зусиль, щоб пацієнти, які перебувають в нашому
                                                                    стаціонарі швидше отримували необхідні маніпуляції з
                                                                    дотриманням строгих заходів безпеки і комфорту.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6 d-none d-lg-flex">
                                                        <a href="img/media/image-234.jpeg"
                                                            data-fancybox="media--gallery-1" class="w-100">
                                                            <div class="wrap-img">
                                                                <img src="img/media/image-234.jpeg" alt="img">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="media--swiper">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-235.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-235.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-236.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-236.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-237.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-237.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-238.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-238.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-239.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-239.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-233.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-233.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-234.jpeg"
                                                                        data-fancybox="media--gallery-1">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-234.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-pagination mt-5 d-xl-none"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-hospitals-list-2">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-hospitals-list-2" aria-expanded="false"
                                            aria-controls="collapse-accordion-hospitals-list-2">Стаціонар 2</div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-hospitals-list-2" class="collapse"
                                    aria-labelledby="heading-accordion-hospitals-list-2"
                                    data-parent="#accordion-hospitals-list">
                                    <div class="card-body media-content">
                                        <div class="row flex-column-reverse flex-lg-row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <div
                                                            class="media-content--inner row flex-column-reverse flex-lg-row">
                                                            <div class="col-12 col-lg-6">
                                                                <div class="content-wrap">
                                                                    <div class="content os-scrollbar-overflow">
                                                                        <p>Хірургія - великий відділ медицини, що вивчає та
                                                                            займається лікуванням захворювань, травм із
                                                                            застосуванням оперативних методик. У клініці
                                                                            Геліос у Дніпрі надаються хірургічні послуги у
                                                                            повному обсязі.</p>
                                                                        <p>Хірургічне відділення центру сімейного здоров'я
                                                                            та реабілітації «Геліос» надає допомогу за
                                                                            такими напрямами, як загальна, судинна хірургія
                                                                            та проктологія. Відділення оснащене сучасним
                                                                            обладнанням, лапароскопічним комплексом, що
                                                                            дозволяє виконувати операції різного рівня
                                                                            складності.</p>
                                                                        <p>Хірургія - великий відділ медицини, що вивчає та
                                                                            займається лікуванням захворювань, травм із
                                                                            застосуванням оперативних методик. У клініці
                                                                            Геліос у Дніпрі надаються хірургічні послуги у
                                                                            повному обсязі.</p>
                                                                        <p>Хірургічне відділення центру сімейного здоров'я
                                                                            та реабілітації «Геліос» надає допомогу за
                                                                            такими напрямами, як загальна, судинна хірургія
                                                                            та проктологія. Відділення оснащене сучасним
                                                                            обладнанням, лапароскопічним комплексом, що
                                                                            дозволяє виконувати операції різного рівня
                                                                            складності.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 d-none d-lg-flex">
                                                                <a href="img/media/image-226.jpeg"
                                                                    data-fancybox="media--gallery-2" class="w-100">
                                                                    <div class="wrap-img">
                                                                        <img src="img/media/image-226.jpeg"
                                                                            alt="img">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="media--swiper">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-235.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-235.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-236.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-236.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-237.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-237.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-238.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-238.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-239.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-239.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-233.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-233.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-234.jpeg"
                                                                        data-fancybox="media--gallery-2">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-234.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-pagination mt-5 d-xl-none"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-0" id="heading-accordion-hospitals-list-3">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-accordion-hospitals-list-3" aria-expanded="false"
                                            aria-controls="collapse-accordion-hospitals-list-3">Стаціонар 3</div>
                                    </div>
                                </div>
                                <div id="collapse-accordion-hospitals-list-3" class="collapse"
                                    aria-labelledby="heading-accordion-hospitals-list-3"
                                    data-parent="#accordion-hospitals-list">
                                    <div class="card-body media-content">
                                        <div class="row flex-column-reverse flex-lg-row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <div
                                                            class="media-content--inner row flex-column-reverse flex-lg-row">
                                                            <div class="col-12 col-lg-6">
                                                                <div class="content-wrap">
                                                                    <div class="content os-scrollbar-overflow">
                                                                        <p>Хірургія - великий відділ медицини, що вивчає та
                                                                            займається лікуванням захворювань, травм із
                                                                            застосуванням оперативних методик. У клініці
                                                                            Геліос у Дніпрі надаються хірургічні послуги у
                                                                            повному обсязі.</p>
                                                                        <p>Хірургічне відділення центру сімейного здоров'я
                                                                            та реабілітації «Геліос» надає допомогу за
                                                                            такими напрямами, як загальна, судинна хірургія
                                                                            та проктологія. Відділення оснащене сучасним
                                                                            обладнанням, лапароскопічним комплексом, що
                                                                            дозволяє виконувати операції різного рівня
                                                                            складності.</p>
                                                                        <p>Хірургія - великий відділ медицини, що вивчає та
                                                                            займається лікуванням захворювань, травм із
                                                                            застосуванням оперативних методик. У клініці
                                                                            Геліос у Дніпрі надаються хірургічні послуги у
                                                                            повному обсязі.</p>
                                                                        <p>Хірургічне відділення центру сімейного здоров'я
                                                                            та реабілітації «Геліос» надає допомогу за
                                                                            такими напрямами, як загальна, судинна хірургія
                                                                            та проктологія. Відділення оснащене сучасним
                                                                            обладнанням, лапароскопічним комплексом, що
                                                                            дозволяє виконувати операції різного рівня
                                                                            складності.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 d-none d-lg-flex">
                                                                <a href="img/media/image-226.jpeg"
                                                                    data-fancybox="media--gallery-3" class="w-100">
                                                                    <div class="wrap-img">
                                                                        <img src="img/media/image-226.jpeg"
                                                                            alt="img">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="media--swiper">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-235.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-235.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-236.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-236.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-237.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-237.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-238.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-238.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-239.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-239.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-233.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-233.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <a href="img/media/image-234.jpeg"
                                                                        data-fancybox="media--gallery-3">
                                                                        <div class="wrap-img">
                                                                            <img src="img/media/image-234.jpeg"
                                                                                alt="img">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-pagination mt-5 d-xl-none"></div>
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
    </main>
@endsection
