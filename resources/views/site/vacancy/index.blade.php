@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url,
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => __('web.main'),
                'url' => route('main'),
            ],
            [
                'title' => __('pages.vacancies'),
                'url' => null,
            ],
        ],
    ])
    <section class="opening-top section-top section-top-3 mb-24">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-12 col-lg-6">
                    <div class="media-content">
                        <div class="media-content--inner row flex-column-reverse flex-lg-row">
                            <div class="col-12">
                                <div class="content-wrap content-wrap--min-h d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="h2 font-m font-weight-bolder text-blue mb-5">{{ $page->pageBlocks->first()->title ?? '' }}</div>
                                        <div class="content os-scrollbar-overflow text-justify">
                                            <p>{!! $page->pageBlocks->first()->description ?? '' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-8 mb-lg-0">
                    <div class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                        <div class="backdrop position-static">
                            <div class="wrap-img">
                                @if(!empty($page->pageBlocks->first()->image))
                                    <img class="bg-down" src="{{ $page->pageBlocks->first()->imageUrl }}" alt="{{ $page->pageBlocks->first()->title }}">
                                @else
                                    <img class="bg-down" src="img/img1515.jpeg" alt="img">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our-opening mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="accordion text-justify" id="our-opening-list">
                        @forelse($vacancies as $vacancy)
                            <div class="card">
                                <div class="card-header p-0" id="heading-our-opening-list-{{ $loop->iteration }}">
                                    <div class="h4 mb-0">
                                        <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-our-opening-list-{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse-our-opening-list-{{ $loop->iteration }}">{{ $vacancy->title }}</div>
                                    </div>
                                </div>
                                <div id="collapse-our-opening-list-{{ $loop->iteration }}" class="collapse" aria-labelledby="heading-our-opening-list-{{ $loop->iteration }}" data-parent="#our-opening-list">
                                    <div class="card-body p-5 rounded bg-white mt-3">
                                        <div class="row mb-5">
                                            <div class="col-12 col-lg-3 mb-10 mb-lg-0">
                                                <div class="d-flex align-items-center h-100">
                                                    @if($vacancy->image)
                                                        <div class="wrap-img">
                                                            <img src="{{ $vacancy->imageUrl }}" alt="{{ $vacancy->title ?? '' }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-9">
                                                <p>{!! $vacancy->description !!}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" class="btn d-block btn-blue font-weight-bold ml-auto" data-toggle="modal" data-target="#popup--interview" data-vacancy="{{ $vacancy->title }}">{{ __('web.leave_an_application') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{-- <div class="card">
                            <div class="card-header p-0" id="heading-our-opening-list-2">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-our-opening-list-2" aria-expanded="false" aria-controls="collapse-our-opening-list-2">Адміністратор-хостес</div>
                                </div>
                            </div>
                            <div id="collapse-our-opening-list-2" class="collapse" aria-labelledby="heading-our-opening-list-2" data-parent="#our-opening-list">
                                <div class="card-body p-5 rounded bg-white mt-3">
                                    <div class="row mb-5">
                                        <div class="col-12 col-lg-3 mb-10 mb-lg-0">
                                            <div class="d-flex align-items-center h-100">
                                                <div class="wrap-img">
                                                    <img src="img/logo-name.png" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <p>Хірургія у отоларингології на сьогоднішній день один з найбільш актуальних методів лікування захворювань з перебігом хронічного характеру. Застосовується він у випадках, коли медикаментозна поряд з фізіотерапією не доцільна або не приносить належного ефекту. Практично всі ЛОР-операції та хірургічні маніпуляції проводяться при анестезії (загальній, місцевій). Застосування високотехнологічного сучасного ендоскопічного обладнання дозволяє виконувати навіть складні операції з мінімальним ризиком розвитку ускладнень і високою ефективністю. Ендоскопічні операції на носових пазухах проводять через маленькі проколи в слизових оболонках.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn d-block btn-blue font-weight-bold ml-auto" data-toggle="modal" data-target="#popup--interview">Залишити заявку</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-our-opening-list-3">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-our-opening-list-3" aria-expanded="false" aria-controls="collapse-our-opening-list-3">Медична сестра-анестезіст</div>
                                </div>
                            </div>
                            <div id="collapse-our-opening-list-3" class="collapse" aria-labelledby="heading-our-opening-list-3" data-parent="#our-opening-list">
                                <div class="card-body p-5 rounded bg-white mt-3">
                                    <div class="row mb-5">
                                        <div class="col-12 col-lg-3 mb-10 mb-lg-0">
                                            <div class="d-flex align-items-center h-100">
                                                <div class="wrap-img">
                                                    <img src="img/logo-name.png" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <p>Хірургія у отоларингології на сьогоднішній день один з найбільш актуальних методів лікування захворювань з перебігом хронічного характеру. Застосовується він у випадках, коли медикаментозна поряд з фізіотерапією не доцільна або не приносить належного ефекту. Практично всі ЛОР-операції та хірургічні маніпуляції проводяться при анестезії (загальній, місцевій). Застосування високотехнологічного сучасного ендоскопічного обладнання дозволяє виконувати навіть складні операції з мінімальним ризиком розвитку ускладнень і високою ефективністю. Ендоскопічні операції на носових пазухах проводять через маленькі проколи в слизових оболонках.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn d-block btn-blue font-weight-bold ml-auto" data-toggle="modal" data-target="#popup--interview">Залишити заявку</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-our-opening-list-4">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-our-opening-list-4" aria-expanded="false" aria-controls="collapse-our-opening-list-4">Медична сестра операційна</div>
                                </div>
                            </div>
                            <div id="collapse-our-opening-list-4" class="collapse" aria-labelledby="heading-our-opening-list-4" data-parent="#our-opening-list">
                                <div class="card-body p-5 rounded bg-white mt-3">
                                    <div class="row mb-5">
                                        <div class="col-12 col-lg-3 mb-10 mb-lg-0">
                                            <div class="d-flex align-items-center h-100">
                                                <div class="wrap-img">
                                                    <img src="img/logo-name.png" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <p>Хірургія у отоларингології на сьогоднішній день один з найбільш актуальних методів лікування захворювань з перебігом хронічного характеру. Застосовується він у випадках, коли медикаментозна поряд з фізіотерапією не доцільна або не приносить належного ефекту. Практично всі ЛОР-операції та хірургічні маніпуляції проводяться при анестезії (загальній, місцевій). Застосування високотехнологічного сучасного ендоскопічного обладнання дозволяє виконувати навіть складні операції з мінімальним ризиком розвитку ускладнень і високою ефективністю. Ендоскопічні операції на носових пазухах проводять через маленькі проколи в слизових оболонках.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn d-block btn-blue font-weight-bold ml-auto" data-toggle="modal" data-target="#popup--interview">Залишити заявку</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="heading-our-opening-list-5">
                                <div class="h4 mb-0">
                                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-our-opening-list-5" aria-expanded="false" aria-controls="collapse-our-opening-list-5">Молодша медична сестра</div>
                                </div>
                            </div>
                            <div id="collapse-our-opening-list-5" class="collapse" aria-labelledby="heading-our-opening-list-5" data-parent="#our-opening-list">
                                <div class="card-body p-5 rounded bg-white mt-3">
                                    <div class="row mb-5">
                                        <div class="col-12 col-lg-3 mb-10 mb-lg-0">
                                            <div class="d-flex align-items-center h-100">
                                                <div class="wrap-img">
                                                    <img src="img/logo-name.png" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <p>Хірургія у отоларингології на сьогоднішній день один з найбільш актуальних методів лікування захворювань з перебігом хронічного характеру. Застосовується він у випадках, коли медикаментозна поряд з фізіотерапією не доцільна або не приносить належного ефекту. Практично всі ЛОР-операції та хірургічні маніпуляції проводяться при анестезії (загальній, місцевій). Застосування високотехнологічного сучасного ендоскопічного обладнання дозволяє виконувати навіть складні операції з мінімальним ризиком розвитку ускладнень і високою ефективністю. Ендоскопічні операції на носових пазухах проводять через маленькі проколи в слизових оболонках.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn d-block btn-blue font-weight-bold ml-auto" data-toggle="modal" data-target="#popup--interview">Залишити заявку</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
