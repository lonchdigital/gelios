<footer class="footer bg-blue text-white">
	<div class="footer-main py-12 py-lg-16">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="row">
						<div class="col-12 col-md d-flex flex-md-column flex-wrap align-items-center align-items-md-start justify-content-between justify-content-md-start mb-11 mb-md-0">
							<div class="footer-logo--wrap">
								<div class="footer-logo mb-0 mb-md-5">
									<img src="{{ $footerImage ?? asset('static_images/logo-footer.png') }}" alt="logo">
								</div>
							</div>
							<div class="footer-descrp mb-0 mb-md-4 mt-11 mt-md-0">
                                {!! $description ?? '<p class="mb-0 font-weight-normal">
                                    Медичний центр сімейного здоров\'я та реабілітації Геліос - це сучасне обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта.
                                </p>' !!}
							</div>
							<div class="socials">
								<ul class="list-inline mb-0">
									<li class="list-inline-item">
										<a href="{{ $facebook ?? '##' }}" target="_BLANK">
											<svg class="i-facebook">
												<use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-facebook' }}"></use>
											</svg>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="{{ $instagram ?? '##' }}" target="_BLANK">
											<svg class="i-instagram">
												<use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-instagram' }}"></use>
											</svg>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="{{ $youtube ?? '##' }}" target="_BLANK">
											<svg class="i-youtube">
												<use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-youtube' }}"></use>
											</svg>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col">
							<div class="ml-xxl-2">
								<div class="h4 mb-5 font-weight-bold">{{ __('pages.directions') }}</div>
								<ul class="list-unstyled mb-0">
                                    @forelse($directions ?? [] as $direction)
                                        {{-- @if(!empty($direction->page->slug)) --}}
                                            <li><a
                                            @switch(LaravelLocalization::getCurrentLocale())
                                                        @case('ua')
                                                            href="{{ '/ua/' . $direction->page->buildFullPath() ?? '##' }}"
                                                        @break

                                                        @case('en')
                                                            href="{{ '/en/' . $direction->page->buildFullPath() ?? '##' }}"
                                                        @break

                                                        @default
                                                            href="{{ '/' . $direction->page->buildFullPath() ?? '##' }}"
                                                    @endswitch()
                                            >{{ $direction->page->name ?? '' }}</a></li>
                                        {{-- @endif --}}
                                    @empty
                                    @endforelse
								</ul>
							</div>
						</div>
						<div class="col">
							<div class="ml-xxl-3">
								<div class="h4 mb-5 font-weight-bold">{{ __('pages.information') }}</div>
								<ul class="list-unstyled mb-0">
                                    @forelse($infos ?? [] as $info)
                                        <li><a
                                            @switch(LaravelLocalization::getCurrentLocale())
                                                        @case('ua')
                                                            href="{{ '/ua/' . $info->page->slug ?? '##' }}"
                                                        @break

                                                        @case('en')
                                                            href="{{ '/en/' . $info->page->slug ?? '##' }}"
                                                        @break

                                                        @default
                                                            href="{{ '/' . $info->page->slug ?? '##' }}"
                                                    @endswitch()
                                            >{{ $info->page->title ?? __('admin.' . $info->page->type) }}</a></li>
                                    @empty
                                    @endforelse
								</ul>
							</div>
						</div>
						<div class="footer-contacts col-12 col-xl-5 mt-11 mt-xl-0">
							<div class="ml-xxl-4">

                                @forelse($affiliates ?? [] as $affiliate)
                                    @if($loop->iteration < 5)
                                        @if($loop->iteration == 1)
                                            <div class="row mb-11 mb-xl-16">
                                        @endif

                                        @if($loop->iteration == 3)
                                            <div class="row">
                                        @endif

                                            <div class="col-12 col-md @if($loop->iteration == 1 || $loop->iteration == 3) mb-11 mb-md-0 @endif">
                                                @if(!empty($affiliate->address))
                                                    <div class="h4 mb-5 font-weight-bold">{{ $affiliate->address }}</div>
                                                @endif
                                                <ul class="list-unstyled mb-0">
                                                    @if(!empty($affiliate->first_phone))
                                                        <li>
                                                            <a href="tel:{{ $affiliate->first_phone }}">
                                                                <div class="link-phone">{{ $affiliate->first_phone }}</div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(!empty($affiliate->second_phone))
                                                        <li>
                                                            <a href="tel:{{ $affiliate->second_phone }}">
                                                                <div class="link-phone">{{ $affiliate->second_phone }}</div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <button type="button" class="contact-details" data-toggle="modal" data-target="#popup--contacts"
                                                        data-city="{{ __('web.dnipro') }}"
                                                        data-affiliates="{{ $affiliates ?? [] }}"
                                                        {{-- @forelse($affiliates as $affiliate2)
                                                            @switch($loop->iteration)
                                                                @case(1)
                                                                    data-first="{{ $affiliate2 }}"
                                                                    @break

                                                                @case(2)
                                                                    data-second="{{ $affiliate2 }}"
                                                                    @break

                                                                @case(3)
                                                                    data-third="{{ $affiliate2 }}"
                                                                    @break

                                                                @case(4)
                                                                    data-fourth="{{ $affiliate2 }}"
                                                                    @break

                                                                @default

                                                            @endswitch
                                                        @empty
                                                        @endforelse --}}
                                                        >{{ __('pages.view') }}</button>
                                                    </li>
                                                </ul>
                                            </div>

                                        @if($loop->iteration == 2 || $loop->iteration == 4)
                                            </div>
                                        @endif
                                    @endif
                                    @empty
                                    @endforelse

								{{-- <div class="row mb-11 mb-xl-16">
									<div class="col-12 col-md mb-11 mb-md-0">
										<div class="h4 mb-5 font-weight-bold">Медичний центр на Вернадського</div>
										<ul class="list-unstyled mb-0">
											<li>
												<a href="tel:+38 (095) 000-01-50">
													<div class="link-phone">+38 (095) 000-01-50</div>
												</a>
											</li>
											<li>
												<a href="tel:+38 (050) 325-62-93">
													<div class="link-phone">+38 (050) 325-62-93</div>
												</a>
											</li>
											<li>
												<button type="button" class="contact-details" data-toggle="modal" data-target="#popup--contacts">Переглянути</button>
											</li>
										</ul>
									</div>
									<div class="col-12 col-md">
										<div class="h4 mb-5 font-weight-bold">Медичний центр на Ламаній</div>
										<ul class="list-unstyled mb-0">
											<li>
												<a href="tel:+38 (095) 000-01-50">
													<div class="link-phone">+38 (095) 000-01-50</div>
												</a>
											</li>
											<li>
												<a href="tel:+38 (050) 325-62-93">
													<div class="link-phone">+38 (050) 325-62-93</div>
												</a>
											</li>
											<li>
												<button type="button" class="contact-details" data-toggle="modal" data-target="#popup--contacts">Переглянути</button>
											</li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md mb-11 mb-md-0">
										<div class="h4 mb-5 font-weight-bold">Медичний центр на Зоряному</div>
										<ul class="list-unstyled mb-0">
											<li>
												<a href="tel:+38 (095) 000-01-50">
													<div class="link-phone">+38 (095) 000-01-50</div>
												</a>
											</li>
											<li>
												<a href="tel:+38 (050) 325-62-93">
													<div class="link-phone">+38 (050) 325-62-93</div>
												</a>
											</li>
											<li>
												<button type="button" class="contact-details" data-toggle="modal" data-target="#popup--contacts">Переглянути</button>
											</li>
										</ul>
									</div>
									<div class="col-12 col-md">
										<div class="h4 mb-5 font-weight-bold">Медичний центр на Новомосковську</div>
										<ul class="list-unstyled mb-0">
											<li>
												<a href="tel:+38 (095) 000-01-50">
													<div class="link-phone">+38 (095) 000-01-50</div>
												</a>
											</li>
											<li>
												<a href="tel:+38 (050) 325-62-93">
													<div class="link-phone">+38 (050) 325-62-93</div>
												</a>
											</li>
											<li>
												<button type="button" class="contact-details" data-toggle="modal" data-target="#popup--contacts">Переглянути</button>
											</li>
										</ul>
									</div>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="regulation bg-white py-2">
		<div class="container">
			<div class="row">
				<div class="col">
					<ul class="list-unstyled list-inline d-flex flex-column flex-xxl-row align-items-center justify-content-center justify-content-xxl-between text-center text-xxl-right mb-0">
						@foreach ($footerPages as $footerPage)
							@if($footerPage->slug === 'dogovor-oferty')
								<li class="list-inline-item text-center"><a href="{{ route('web.page.show', ['slug' => $footerPage->slug]) }}">{{ $footerPage->title }}</a></li>
							@else
								<li class="list-inline-item text-center"><a href="{{ route('articles.show', ['slug' => $footerPage->slug]) }}">{{ $footerPage->title }}</a></li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom bg-blue text-white py-2">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<div class="copyright">© {{ now()->year }} {{ __('pages.helyos') }}. {{ __('pages.all_rights_reserved') }}</div>
				</div>
			</div>
		</div>
	</div>
</footer>
