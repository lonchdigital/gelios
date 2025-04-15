<div class="push-menu--lvl">
    <div class="category-directions">
        <div class="category-directions--list">
            <div class="row">
                @foreach ($data as $oneChildDirection)
                    <div class="col-12 col-lg-4 position-static">
                        @if( $oneChildDirection['children'] )
                            <div class="directions-item">
                                <div class="content item has-dropdown">
                                    <a href="{{ $oneChildDirection['full_path'] }}" class="link">
                                        <span>{{ $oneChildDirection['name'] }}</span>
                                        <div class="i-link btn-nav-forward"></div>
                                    </a>
                                    <x-site.directions.section-menu :data="$oneChildDirection['children']" />
                                </div>
                            </div>
                        @else
                            <div class="directions-item">
                                <div class="content">
                                    <a class="link" href="{{ $oneChildDirection['full_path'] }}">
                                        {{ $oneChildDirection['name'] }}
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