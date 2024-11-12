@extends('site.layout.app')

@section('head')
    @vite(['resources/js/forms/reviewForm.js'])
@endsection

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
            @include('site.components.text-section-review-button', ['data' => $page->pageTextBlocks->where('number', 1)->first()])
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
					<form action="#" id="user-write-review" class="form-popup--write-review" autocomplete="off" enctype='multipart/form-data'>
						@csrf
						<div class="row">
							<div class="col position-static">
								<div class="d-flex align-items-start justify-content-between mb-5">
									<div class="h2 font-m modal-title font-weight-bolder mb-0 pr-8">Залишити відгук</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">
											<svg width="24.000000" height="24.000000" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
												<desc>
														Created with Pixso.
												</desc>
												<defs>
													<clipPath id="clip2452_21769">
														<rect id="close-icon" width="24.000000" height="24.000000" fill="white" fill-opacity="0"/>
													</clipPath>
												</defs>
												<rect id="close-icon" width="24.000000" height="24.000000" fill="#FFFFFF" fill-opacity="0"/>
												<g clip-path="url(#clip2452_21769)">
													<path id="Vector" d="M7.05 16.94L16.94 7.04" stroke="#3DA6D3" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
													<path id="Vector" d="M7.05 7.05L16.94 16.95" stroke="#3DA6D3" stroke-opacity="1.000000" stroke-width="2.000000" stroke-linejoin="round" stroke-linecap="round"/>
												</g>
											</svg>
										</span>
									</button>
								</div>
							</div>
						</div>
						<div class="row field-wrap">
							<div class="col-12 mb-3 text-center image-field">
								<button type="button" class="btn btn-review-add-pic">
									<svg width="40.000000" height="40.000000" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<desc>
												Created with Pixso.
										</desc>
										<defs>
											<clipPath id="clip2468_9843">
												<rect id="photo-icon" width="40.000000" height="40.000000" fill="white" fill-opacity="0"/>
											</clipPath>
										</defs>
										<rect id="photo-icon" width="40.000000" height="40.000000" fill="#FFFFFF" fill-opacity="0"/>
										<g clip-path="url(#clip2468_9843)">
											<path id="Vector" d="M15.83 6.66L11.66 11.66L6.66 11.66C5.78 11.66 4.93 12.01 4.3 12.64C3.68 13.26 3.33 14.11 3.33 15L3.33 30C3.33 30.88 3.68 31.73 4.3 32.35C4.93 32.98 5.78 33.33 6.66 33.33L33.33 33.33C34.21 33.33 35.06 32.98 35.68 32.35C36.31 31.73 36.66 30.88 36.66 30L36.66 15C36.66 14.11 36.31 13.26 35.68 12.64C35.06 12.01 34.21 11.66 33.33 11.66L28.33 11.66L24.16 6.66L15.83 6.66Z" stroke="#FFFFFF" stroke-opacity="1.000000" stroke-width="3.000000" stroke-linejoin="round"/>
											<path id="Vector" d="M20 26.66C17.23 26.66 15 24.42 15 21.66C15 18.9 17.23 16.66 20 16.66C22.76 16.66 25 18.9 25 21.66C25 24.42 22.76 26.66 20 26.66Z" stroke="#FFFFFF" stroke-opacity="1.000000" stroke-width="3.000000" stroke-linejoin="round"/>
										</g>
									</svg>
								</button>
								<input type="file" name="image" class="d-none">
							</div>
							<div class="col-12">
								<div class="field mb-2">
									<label class="control-label mb-2" for="form-write-review--name">{{ trans('web.enter_full_name') }}</label>
									<input type="text" name="name" id="form-write-review--name" class="form-control name-field mb-2">
									<div class="field--help-info small-txt text-red mb-2">{{ trans('web.enter_full_name') }}</div>
								</div>
							</div>
							<div class="col-12">
								<div class="field mb-2">
									<div class="control-label mb-2">{{ trans('web.leave_an_review') }}</div>
									<div class="textarea-container review-field">
										<textarea name="review" class="form-textarea art-review-text form-control h-100" rows="8" maxlength="300" placeholder="{{ trans('web.review_example') }}"></textarea>
										<div class="textarea-counter"><span class="count">0</span> / 300</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<input type="hidden" name="locale" value="{{ app()->getLocale() }}">
								<button type="submit" class="btn btn-blue font-weight-bold w-100 mt-2">{{ trans('web.leave_review') }}</button>
								<button type="button" class="art-open-review-success d-none" data-toggle="modal" data-target="#popup--review-thank" data-dismiss="modal" aria-label="Close"></button>
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
