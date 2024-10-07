<div class="push-menu--lvl">
    <div class="category-directions">
        <div class="category-directions--list">
            <div class="row">
                @foreach ($data as $oneChildDirection)
                    <div class="col-12 col-lg-4 position-static">
                        <div class="directions-item">
                            <div class="content {{ ($oneChildDirection['children']) ? 'item has-dropdown' : '' }}">
                                <a href="##" class="link">
                                    <span>{{ $oneChildDirection['name'] }}</span>
                                    @if( $oneChildDirection['children'] )
                                        <div class="i-link"></div>
                                    @endif
                                </a>
                                @if( $oneChildDirection['children'] )
                                    @include('site.directions.partials.section-menu', ['data' => $oneChildDirection['children']])
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>