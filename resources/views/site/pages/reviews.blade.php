@extends('site.layout.app')

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? '',
                'url' => null,
            ],
        ],
    ])

    <section class="section-top-reviews section-top section-top-3 mb-24">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-12 col-lg-6">
                    <div class="media-content">
                        <div class="media-content--inner row flex-column-reverse flex-lg-row">
                            <div class="col-12">
                                <div class="content-wrap d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="h2 font-m font-weight-bolder text-blue mb-5">Відгуки</div>
                                        <div class="content os-scrollbar-overflow">
                                            <p>Ми відкриті для співпраці зі страховими компаніями і партнерами по обслуговуванню Пацієнтів з добровільного медичного страхування. Якщо у Вас є поліс ДМС, Ви можете звернутися в свою страхову компанію і попросити додати нашу клініку в програму.</p>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col col-lg-auto">
                                            <button type="button" class="btn btn-outline-blue font-weight-bold px-lg-10" data-toggle="modal" data-target="#popup--write-review">Залишити відгук</button>
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
                                <img class="bg-down" src="{{ asset('static_images/img1515.jpeg') }}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reviews" class="reviews mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reviews-list row">

                        @foreach ($reviews as $review)
                            <div class="content-item col-12 col-lg-6 mt-11">
                                <div class="reviews--item">
                                    <div class="inner">
                                        <div class="wrap-img">
                                            <img src="{{ '/storage/' . $review->image }}" alt="img">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="user-name h4 font-weight-bolder">{{ $review->name }}</div>
                                            <div class="reviews-date h6 font-weight-bold text-grey">{{ $review->created_at->format('d.m.Y') }}</div>
                                        </div>
                                        <div class="reviews--content os-scrollbar-overflow">{!! $review->text !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="mt-5 mt-lg-3">
                        {{ $reviews->links('vendor.pagination.default') }}
                        {{-- <ul class="pagination justify-content-center mb-0"></ul> --}}
                    </nav>
                </div>
            </div>
        </div>
    </section>



    <div class="modal modal--custom popup--write-review fade" id="popup--write-review" data-keyboard="false" tabindex="-1" aria-labelledby="popup--write-reviewLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content py-5 px-3 py-md-13 px-md-11">
				<div class="modal-body p-0">
					<form class="form-popup--write-review" autocomplete="off">
						<div class="row">
							<div class="col position-static">
								<div class="d-flex align-items-start justify-content-between mb-5">
									<div class="h2 font-m modal-title font-weight-bolder mb-0 pr-8">Залишити відгук</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">
											<svg>
												<use xlink:href="img/icons/icons.svg#i-close"></use>
											</svg>
										</span>
									</button>
								</div>
							</div>
						</div>
						<div class="row field-wrap">
							<div class="col-12 mb-3 text-center">
								<button type="button" class="btn btn-review-add-pic">
									<svg>
										<use xlink:href="img/icons/icons.svg#i-photo"></use>
									</svg>
								</button>
							</div>
							<div class="col-12">
								<div class="field mb-2">
									<label class="control-label mb-2" for="form-write-review--name">Вкажіть ПІБ</label>
									<input type="text" id="form-write-review--name" class="form-control mb-2">
									<div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
								</div>
							</div>
							<div class="col-12">
								<div class="field mb-2">
									<div class="control-label mb-2">Залиште відгук</div>
									<div class="textarea-container">
										<textarea class="form-textarea form-control h-100" rows="8" maxlength="300" placeholder="Наприклад, усе дуже професійно в цьому медичному центрі для реабілітації після травми..."></textarea>
										<div class="textarea-counter"><span class="count">0</span> / 300</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<button type="button" class="btn btn-blue font-weight-bold w-100 mt-2" data-toggle="modal" data-target="#popup--review-thank" data-dismiss="modal" aria-label="Close">Залишити відгук</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal modal--custom popup--review-thank fade" id="popup--review-thank" data-keyboard="false" tabindex="-1" aria-labelledby="popup--review-thankLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content py-5 px-3 py-md-13 px-md-11">
				<div class="modal-body p-0">
					<form class="form-popup--review-thank" autocomplete="off">
						<div class="row">
							<div class="col">
								<div class="text-center py-4 py-md-0 my-lg-7">
									<div class="i-check mb-5">
										<svg>
											<use xlink:href="img/icons/icons.svg#i-double-check"></use>
										</svg>
									</div>
									<div class="h4 font-m font-weight-bolder">Дякуємо за відгук!</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
