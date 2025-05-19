<div class="scrollable-content--inner">
    @foreach ($data as $childCatDir)
        @if( $childCatDir['children'] )
            <div class="item has-dropdown">
                <span data-slug="{{ $childCatDir['full_path'] }}">{{ $childCatDir['name'] }}</span>

                <div class="push-menu--lvl scrollable-content">
                    <x-site.directions.header-mob-menu :data="collect($childCatDir['children'])" />
                </div>
            </div>
        @else
            <a href="{{ $childCatDir['full_path'] }}">{{ $childCatDir['name'] }}</a>
        @endif
    @endforeach
</div>