<div class="push-menu--aside">
    @foreach ($data->where('template', 3) as $childDirection)
        <div class="item"><a href="{{ $childDirection['full_path'] }}">{{ $childDirection['name'] }}</a></div>
    @endforeach
</div>

<div class="push-menu--category">
    @foreach ($data->where('template', 2) as $childCatDir)
        <div class="push-menu--sub-category">

            @if( $childCatDir['children'] )
                <div class="item has-dropdown main-title">
                    <span class="heading" data-slug="{{ $childCatDir['full_path'] }}">{{ $childCatDir['name'] }}</span>
                    <div class="push-menu--lvl">
                        <x-site.directions.header-menu :data="collect($childCatDir['children'])" />
                    </div>
                </div>
            @else
                <div class="item main-title">
                    <a href="{{ $childCatDir['full_path'] }}" class="heading">{{ $childCatDir['name'] }}</a>
                </div>
            @endif

            @foreach (collect($childCatDir['children']) as $childSubCatDir)

                @if( $childSubCatDir['children'] )
                    <div class="item has-dropdown">
                        <a href="##" data-slug="{{ $childSubCatDir['full_path'] }}">{{ $childSubCatDir['name'] }}</a>
                        <div class="push-menu--lvl">
                            <x-site.directions.header-menu :data="collect($childSubCatDir['children'])" />
                        </div>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ $childSubCatDir['full_path'] }}">{{ $childSubCatDir['name'] }}</a>
                    </div>
                @endif
                
            @endforeach

        </div>
    @endforeach
</div>