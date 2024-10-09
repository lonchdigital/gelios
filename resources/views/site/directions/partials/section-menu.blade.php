<div class="push-menu--lvl">
    <div class="category-directions">
        <div class="category-directions--list">
            <div class="row">
                @foreach ($data as $oneChildDirection)
                    <div class="col-12 col-lg-4 position-static">
                        @if( $oneChildDirection['children'] )
                            <div class="directions-item">
                                <div class="content item has-dropdown">
                                    <a href="##" class="link">
                                        <span>{{ $oneChildDirection['name'] }}</span>
                                        <div class="i-link"></div>
                                    </a>
                                    @include('site.directions.partials.section-menu', ['data' => $oneChildDirection['children']])
                                </div>
                            </div>
                        @else
                            <div class="directions-item">
                                <div class="content">
                                    @if ($oneChildDirection['template'] === 1)
                                        <a class="link" href="{{ route('direction.category', ['pageDirection' => $oneChildDirection['slug']]) }}">
                                            {{ $oneChildDirection['name'] }}
                                        </a>
                                    @elseif ($oneChildDirection['template'] === 2)
                                        <a class="link" href="{{ route('direction.sub-category', ['pageDirection' => $oneChildDirection['slug']]) }}">
                                            {{ $oneChildDirection['name'] }}
                                        </a>
                                    @elseif ($oneChildDirection['template'] === 3)
                                        <a class="link" href="{{ route('direction.itself', ['pageDirection' => $oneChildDirection['slug']]) }}">
                                            {{ $oneChildDirection['name'] }}
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