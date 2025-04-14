<div class="push-menu--lvl">
    <div class="category-directions">
        <div class="category-directions--list">
            <div class="row">
                @foreach ($data as $oneChildDirection)
                    <div class="col-12 col-lg-4 position-static">
                        @if( $oneChildDirection['children'] )
                            <div class="directions-item">
                                <div class="content item has-dropdown">
                                    <div class="link">
                                        <a href="{{ $oneChildDirection['full_path'] }}">{{ $oneChildDirection['name'] }}</a>
                                        <a href="##" class="i-link"></a>
                                    </div>
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