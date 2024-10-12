<section class="our-directions offices-direction bg-blue mb-24">
    <div class="container">
        <div class="row flex-column flex-xl-row py-12">
            <div class="col-12 col-xl-3 text-white mb-5 mb-xl-0 d-flex flex-column">
                <div class="h2 font-m font-weight-bolder mb-5">Наші напрямки</div>
                <div class="h5 font-weight-bold mb-5">Передові медичні технології діагностики, лікування та
                    реабілітації пацієнтів усіх вікових груп.</div>
                <div class="row">
                    <div class="col-auto">
                        <a href="##"
                            class="btn btn-fz-20 btn-outline-white font-weight-bold d-none d-xl-block">Усі
                            напрямки</a>
                        <a href="##" class="btn btn-white font-weight-bold d-xl-none">Усі напрямки</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-9">
                <div class="row">
                    <div class="col">
                        <div class="push-menu">
                            <div class="push-menu--nav">
                                <div class="nav-toggle">
                                    <a href="##" class="btn-nav-back btn-nav-direction btn font-weight-bold ml-auto mb-6"><span>Назад</span><span class="icon"></span></a>
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
                                                                        @if ($oneDirection['template'] === 1)
                                                                            <a class="link" href="{{ route('direction.category', ['pageDirection' => $oneDirection['slug']]) }}">
                                                                                {{ $oneDirection['name'] }}
                                                                            </a>
                                                                        @elseif ($oneDirection['template'] === 2)
                                                                            <a class="link" href="{{ route('direction.sub-category', ['pageDirection' => $oneDirection['slug']]) }}">
                                                                                {{ $oneDirection['name'] }}
                                                                            </a>
                                                                        @elseif ($oneDirection['template'] === 3)
                                                                            <a class="link" href="{{ route('direction.itself', ['pageDirection' => $oneDirection['slug']]) }}">
                                                                                {{ $oneDirection['name'] }}
                                                                            </a>
                                                                        @endif
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