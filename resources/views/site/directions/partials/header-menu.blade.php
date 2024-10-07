
<div class="push-menu--aside">
    @foreach ($data->where('template', 3) as $childDirection)
        <div class="item"><a href="##">{{ $childDirection['name'] }}</a></div>
    @endforeach
</div>

<div class="push-menu--category">
    @foreach ($data->where('template', 2) as $childCatDir)
        <div class="push-menu--sub-category">

            <div class="item has-dropdown main-title">
                <a href="##" class="heading">{{ $childCatDir['name'] }}</a>
                @if( $childCatDir['children'] )
                    <div class="push-menu--lvl">
                        @include('site.directions.partials.header-menu', ['data' => collect($childCatDir['children'])])
                    </div>
                @endif
            </div>

            @foreach (collect($childCatDir['children']) as $childSubCatDir)
                <div class="item has-dropdown">
                    <a href="##">{{ $childSubCatDir['name'] }}</a>
                    @if( $childSubCatDir['children'] )
                        <div class="push-menu--lvl">
                            @include('site.directions.partials.header-menu', ['data' => collect($childSubCatDir['children'])])
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    @endforeach
</div>