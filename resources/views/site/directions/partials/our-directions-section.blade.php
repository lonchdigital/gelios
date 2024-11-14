<section class="our-directions offices-direction bg-blue mb-24">
    <div class="container">
        <div class="row flex-column flex-xl-row py-12">
            <div class="col-12 col-xl-3 text-white mb-5 mb-xl-0 d-flex flex-column">
                @if(!is_null($commonDirectionsBlock))
                    <div class="h2 font-m font-weight-bolder mb-5">{{ $commonDirectionsBlock->title }}</div>
                    <div class="h5 font-weight-bold mb-5">{!! $commonDirectionsBlock->description !!}</div>
                @endif
                <div class="row">
                    <div class="col-auto">
                        <a href="{{ route('directions.page') }}" class="btn btn-fz-20 btn-outline-white font-weight-bold d-none d-xl-block">{{ trans('web.all_directions') }}</a>
                        <a href="{{ route('directions.page') }}" class="btn btn-white font-weight-bold d-xl-none">{{ trans('web.all_directions') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-9">
                <div class="row">
                    <div class="col">
                        <div class="push-menu">
                            <div class="push-menu--nav">
                                <div class="nav-toggle">
                                    <a href="##" class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>{{ trans('web.back') }}</span><span class="icon"></span></a>
                                </div>
                                <div class="push-menu--lvl position-relative">
                                    <div class="item has-dropdown">
                                        <div class="category-directions">
                                            <div class="category-directions--list">
                                                <div class="row">
                                                    @foreach ($allDirections as $oneDirection)
                                                        <div class="col-12 col-lg-4 position-static">
                                                            @if( $oneDirection['children'] )
                                                                <div class="directions-item">
                                                                    <div class="content item has-dropdown">
                                                                        <a href="##" class="link">
                                                                            <span>{{ $oneDirection['name'] }}</span>
                                                                            <div class="i-link"></div>
                                                                        </a>
                                                                        @include('site.directions.partials.section-menu', ['data' => $oneDirection['children']])
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="directions-item">
                                                                    <div class="content">
                                                                        <a class="link" href="{{ route('web.page.show', ['slug' => $oneDirection['slug']]) }}">
                                                                            {{ $oneDirection['name'] }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
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
        </div>
    </div>
</section>